import React, { Component } from 'react';
import { inject } from 'lib/Injector';
import i18n from 'i18n';

class ColorPickerField extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    const { PopoverOptionSetComponent, colors } = this.props;

    const buttons = colors.map(({ Title, Color, CSSClass }) => ({
      key: CSSClass,
      text: Title,
      className: `hex-${Color}`,
    }));

    console.log(buttons);

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
  (PopoverOptionSetComponent) => ({ PopoverOptionSetComponent }),
  () => 'ColorPickerField'
)(ColorPickerField);
