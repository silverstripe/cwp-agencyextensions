import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { inject } from 'lib/Injector';
import i18n from 'i18n';
import { Button } from 'reactstrap';

class FontPickerField extends Component {
  constructor(props) {
    super(props);

    this.handleButtonClick = this.handleButtonClick.bind(this);
    this.handleToggle = this.handleToggle.bind(this);

    this.state = {
      isOpen: false,
      value: props.value,
      selectedFont: 'inherit',
    };
  }

  handleButtonClick(button) {
    return () => {
      this.handleToggle();
      this.setState({
        value: button.key,
        selectedFont: button.text
      });
    };
  }

  handleToggle() {
    this.setState({
      isOpen: !this.state.isOpen
    });
  }

  renderSelectorButton() {
    const { value } = this.state;
    const { fonts, name } = this.props;
    let font;

    if (value) {
      font = fonts.find(({ CSSClass }) => CSSClass === value);
    }
    if (!font) {
      font = fonts[0];
    }

    return (
      <Button
        id={`Popover_${name}`}
        onClick={this.handleToggle}
        className="font-picker-field-button font-icon-caret-up-down"
      >
        { font ? font.Title : <em>None</em> }
      </Button>
    );
  }

  renderPopover() {
    const { PopoverOptionSetComponent, fonts, name } = this.props;
    const { isOpen } = this.state;

    const buttons = fonts.map((font) => ({
      key: font.CSSClass,
      content: font.Title,
      className: 'font-picker-field-popover__option',
      buttonProps: { style: { fontFamily: `"${font.Title}"` } },
      text: font.Title,
    }));

    return (
      <PopoverOptionSetComponent
        buttons={buttons}
        provideButtonClickHandler={this.handleButtonClick}
        searchPlaceholder={i18n._t('FontPickerField.SEARCH_BLOCKS', 'Search font families')}
        className="font-picker-field-popover"
        placement="bottom-start"
        isOpen={isOpen}
        target={`Popover_${name}`}
        toggle={this.handleToggle}
      />
    );
  }

  renderSelectedFontPreview() {
    const { selectedFont } = this.state;
    const previewText = i18n._t(
      'FontPickerField.PREVIEW_FONT',
      'The quick brown fox jumped over the lazy dog'
    );
    return (
      <div
        className="font-picker-field__selection-preview"
        style={{ fontFamily: `"${selectedFont}"` || 'inherit' }}
      >
        { previewText }
      </div>
    );
  }

  render() {
    const { name } = this.props;
    const { value } = this.state;

    return (
      <div>
        { this.renderSelectorButton() }
        { this.renderPopover() }
        { this.renderSelectedFontPreview() }
        <input name={name} type="hidden" value={value} />
      </div>
    );
  }
}

FontPickerField.proptypes = {
  fonts: PropTypes.arrayOf(PropTypes.shape({
    Title: PropTypes.text,
    CSSClass: PropTypes.text,
  })),
  name: PropTypes.string,
  value: PropTypes.string,
};

export default inject(
  ['PopoverOptionSet'],
  (PopoverOptionSetComponent) => ({ PopoverOptionSetComponent }),
  () => 'FontPickerField'
)(FontPickerField);
