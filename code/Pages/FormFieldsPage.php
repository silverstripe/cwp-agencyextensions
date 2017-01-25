<?php

class FormFieldsPage extends Page
{

}

class FormFieldsPage_Controller extends Page_Controller
{
    /**
     * @inheritdoc
     *
     * @return Form
     */
    public function Form()
    {
        $options = [
            "a" => "Option 1",
            "b" => "Option 2"
        ];

        $fields = [
            CheckboxField::create("CheckboxField", "Checkbox Field"),
            CheckboxSetField::create("CheckboxSetField", "Checkbox Set Field", $options),
            CountryDropdownField::create("CountryDropdownField", "Country Dropdown Field"),
            CreditCardField::create("CreditCardField", "Credit Card Field"),
            CurrencyField::create("CurrencyField", "Currency Field"),
            DatalessField::create("DatalessField", "DatalessField"),
            DateField::create("DateField", "Date Field"),
            DatetimeField::create("DatetimeField", "Datetime Field"),
            DropdownField::create("DropdownField", "Dropdown Field", $options),
            EmailField::create("EmailField", "Email Field"),
            FileField::create("FileField", "File Field"),
            GroupedDropdownField::create("GroupedDropdownField", "Grouped Dropdown Field", $options),
            HeaderField::create("HeaderField", "Header Field"),
            HtmlEditorField::create("HTMLEditorField", "HTMLEditor Field"),
            LabelField::create("LabelField", "Label Field"),
            ListboxField::create("ListboxField", "Listbox Field", $options),
            LiteralField::create("LiteralField", "This is a literal field"),
            LookupField::create("LookupField", "Lookup Field", $options),
            MoneyField::create("MoneyField", "Money Field"),
            NumericField::create("NumericField", "Numeric Field"),
            OptionsetField::create("OptionsetField", "Optionset Field", $options),
            PasswordField::create("PasswordField", "Password Field"),
            PhoneNumberField::create("PhoneNumberField", "Phone Number Field"),
            ReadonlyField::create("ReadonlyField", "ReadonlyField", "Readonly"),
            // TODO SelectionGroup::create("SelectionGroup", $options),
            TextareaField::create("TextareaField", "Textarea Field"),
            TextField::create("TextField", "Text Field"),
            TimeField::create("TimeField", "Time Field"),
            TreeDropdownField::create("TreeDropdownField", "Tree Dropdown Field", "SiteTree"),
            TreeMultiselectField::create("TreeMultiselectField", "Tree Multiselect Field", "SiteTree")
        ];

        $fieldList = FieldList::create($fields);

        $actions = FieldList::create([
            FormAction::create("ActionNoButton", "No Button"),
            FormAction::create("ActionButton", "Button")->setUseButtonTag(true),
        ]);

        $required = RequiredFields::create([
            "TextField",
            "CheckboxField",
        ]);

        return Form::create($this, "Form", $fieldList, $actions, $required);
    }
}
