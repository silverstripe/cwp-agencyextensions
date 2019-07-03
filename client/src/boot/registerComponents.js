import Injector from 'lib/Injector';
import FontPickerField from 'components/FontPickerField/FontPickerField';

export default () => {
  Injector.component.registerMany({
    FontPickerField,
  });
};
