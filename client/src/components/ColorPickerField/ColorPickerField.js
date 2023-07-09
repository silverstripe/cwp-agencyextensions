import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { inject } from 'lib/Injector';
import i18n from 'i18n';
import { Button } from 'reactstrap';

class ColorPickerField extends Component {
  constructor(props) {
    super(props);

    this.handleToggle = this.handleToggle.bind(this);

    this.state = {
      isOpen: false,
      value: props.value,
    };
  }

  handleToggle() {
    this.setState((prevState) => ({
      isOpen: !prevState.isOpen,
    }));
  }

  renderButton() {
    const { value } = this.state;
    const { colors, name } = this.props;
    let color;

    if (value) {
      color = colors.find(({ CSSClass }) => CSSClass === value);
    }

    color = color || colors[0];

    return (
      <Button
        id={`Popover_${name}`}
        onClick={this.handleToggle}
        className="color-picker-field-button"
      >
        <div
          className="color-picker-field-button__color-icon"
          style={{ backgroundColor: color ? color.Color : 'transparent' }}
        />
        <div className="color-picker-field-button__color-label">
          { color ? color.Title : <em>{i18n._t('ColorPickerField.EMPTY_TITLE', 'None')}</em> }
        </div>
      </Button>
    );
  }

  renderPopover() {
    const { PopoverOptionSetComponent, colors, name } = this.props;
    const { isOpen, value } = this.state;

    const buttonContent = (color) => [
      <span
        className="color-picker-field-popover__option-icon"
        style={{ backgroundColor: color.Color }}
      />,
      <span className="color-picker-field-popover__option-label">
        {color.Title}
      </span>
    ];

    const buttons = colors.map((color) => ({
      key: color.CSSClass,
      content: buttonContent(color),
      className: ['color-picker-field-popover__option', {
        'color-picker-field-popover__option--selected': color.CSSClass === value
      }],
      text: color.Title,
      onClick: () => {
        this.handleToggle();
        this.setState({
          value: color.CSSClass,
        });
      },
    }));

    const handleSearch = (term, set) => set.filter(
      ({ text }) => text.toLowerCase().includes(term.toLowerCase())
    );

    return (
      <PopoverOptionSetComponent
        buttons={buttons}
        searchPlaceholder={i18n._t('ColorPickerField.SEARCH_BLOCKS', 'Search colours')}
        className="color-picker-field-popover"
        placement="bottom-start"
        onSearch={handleSearch}
        isOpen={isOpen}
        target={`Popover_${name}`}
        toggle={this.handleToggle}
      />
    );
  }

  render() {
    const { name } = this.props;
    const { value } = this.state;

    return (
      <div>
        { this.renderButton() }
        { this.renderPopover() }
        <input name={name} type="hidden" value={value} />
      </div>
    );
  }
}

ColorPickerField.propTypes = {
  colors: PropTypes.arrayOf(PropTypes.shape({
    Title: PropTypes.text,
    CSSClass: PropTypes.text,
    Color: PropTypes.text,
  })),
  name: PropTypes.string,
  value: PropTypes.string,
};

export default inject(
  ['PopoverOptionSet'],
  (PopoverOptionSetComponent) => ({ PopoverOptionSetComponent }),
  () => 'ColorPickerField'
)(ColorPickerField);
