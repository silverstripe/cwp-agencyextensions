import Injector from 'lib/Injector';
import ColorPickerField from 'components/ColorPickerField/ColorPickerField';

export default () => {
  Injector.component.registerMany({
    ColorPickerField,
  });
};
