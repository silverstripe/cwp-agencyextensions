import Injector from 'lib/Injector';
import ColorPickerField from 'components/ColorPickerField/ColorPickerField';
import FontPickerField from 'components/FontPickerField/FontPickerField';

export default () => {
  Injector.component.registerMany({
    ColorPickerField,
    FontPickerField,
  });
};
