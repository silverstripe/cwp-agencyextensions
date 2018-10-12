import React, { Component } from 'react';
import { inject } from 'lib/Injector';
import i18n from 'i18n';
import { Button } from 'reactstrap';

class ColorPickerField extends Component {
  constructor(props) {
    super(props);

    this.handleButtonClick = this.handleButtonClick.bind(this);
    this.handleToggle = this.handleToggle.bind(this);

    this.state = {
      isOpen: false,
    };
  }

  handleButtonClick() {

  }

  handleToggle() {
    console.log(this.state.isOpen);
    this.setState({
      isOpen: !this.state.isOpen
    });
  }

  render() {
    const { PopoverOptionSetComponent, colors } = this.props;
    const { isOpen } = this.state;

    const buttons = colors.map(({ Title, Color, CSSClass }) => ({
      key: CSSClass,
      text: <div><span className="color-picker-field__option-color" style={{ backgroundColor: Color }} />{Title}</div>,
    }));

    console.log(buttons);

    return (
      <div>
        <Button id="Popover1" onClick={this.handleToggle}>click me!</Button>
        <PopoverOptionSetComponent
          buttons={buttons}
          onButtonClick={this.handleButtonClick}
          searchPlaceholder={i18n._t('AddElementPopover.SEARCH_BLOCKS', 'Search blocks')}
          extraClass="color-picker-field__popover"
          // container={container}
          isOpen={isOpen}
          // placement={placement}
          target="Popover1"
          toggle={this.handleToggle}
        />
      </div>
    );
  }
}

export default inject(
  ['PopoverOptionSet'],
  (PopoverOptionSetComponent) => ({ PopoverOptionSetComponent }),
  () => 'ColorPickerField'
)(ColorPickerField);
