import React, { Component } from 'react';
import { inject } from 'lib/Injector';

class ColorPickerField extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    const { PopoverOptionSetComponent, colors } = this.props;


    console.log(colors);

    // const buttons = colors.map(({}) => ({
    //
    // }));

    return (
      <PopoverOptionSetComponent
        buttons={buttons}
        onButtonClick={this.handleButtonClick}
        searchPlaceholder={i18n._t('AddElementPopover.SEARCH_BLOCKS', 'Search blocks')}
        extraClass={popoverClassNames}
        container={container}
        isOpen={isOpen}
        placement={placement}
        target={target}
        toggle={this.handleToggle}
      />
    );
  }
}

export default inject(
  ['PopoverOptionSet'],
  (PopoverOptionSetComponent) => ({ PopoverOptionComponent }),
  () => 'ColorPickerField'
)(ColorPickerField);
