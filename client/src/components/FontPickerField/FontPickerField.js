import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { inject } from 'lib/Injector';
import i18n from 'i18n';
import { Button } from 'reactstrap';

class FontPickerField extends Component {
  constructor(props) {
    super(props);

    this.handleToggle = this.handleToggle.bind(this);

    this.state = {
      isOpen: false,
      value: props.value,
      selectedFont: this.getFontByValue(props.value).Title,
    };
  }

  /**
   * Returns a font from props.fonts based on the given value, defaulting to the
   * first item in the fonts list if a font cannot be found.
   * @param  {String} value
   * @return {Object}
   */
  getFontByValue(value) {
    const { fonts } = this.props;
    let font;

    if (value) {
      font = fonts.find(({ CSSClass }) => CSSClass === value);
    }

    font = font || fonts[0];

    return font;
  }

  handleToggle() {
    this.setState((prevState) => ({
      isOpen: !prevState.isOpen,
    }));
  }

  renderSelectorButton() {
    const { value } = this.state;
    const { name } = this.props;
    const font = this.getFontByValue(value);

    return (
      <Button
        id={`Popover_${name}`}
        onClick={this.handleToggle}
        className="font-picker-field-button font-icon-caret-down-two"
      >
        { font ? font.Title : <em>{i18n._t('FontPickerField.EMPTY_TITLE', 'None')}</em> }
      </Button>
    );
  }

  renderPopover() {
    const { PopoverOptionSetComponent, fonts, name } = this.props;
    const { isOpen, value } = this.state;

    const buttons = fonts.map((font) => ({
      key: font.CSSClass,
      content: font.Title,
      className: ['font-picker-field-popover__option', {
        'font-picker-field-popover__option--selected': font.CSSClass === value,
      }],
      buttonProps: { style: { fontFamily: `'${font.Title}'` } },
      text: font.Title,
      onClick: () => {
        this.handleToggle();
        this.setState({
          value: font.CSSClass,
          selectedFont: font.Title,
        });
      }
    }));

    return (
      <PopoverOptionSetComponent
        disableSearch
        buttons={buttons}
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

    const previewTextSentence = i18n._t(
      'FontPickerField.PREVIEW_FONT_SENTENCE',
      'The quick brown fox jumps over the lazy dog.'
    );
    const previewTextAlphabet = i18n._t(
      'FontPickerField.PREVIEW_FONT_ALPHABET',
      'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz 0123456789 - = _ + < > ? / . , : "'
    );
    return (
      <div
        className="font-picker-field__selection-preview"
        style={{ fontFamily: `'${selectedFont}'` || 'inherit' }}
      >
        { previewTextSentence }
        <br />
        { previewTextAlphabet }
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

FontPickerField.propTypes = {
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
