<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'required' => 'Поле :attribute обов\'язкове до заповнення.',
    'min' => [
        'string' => 'Поле :attribute не може містити менше ніж :min символів.',
    ],
    'max' => [
        'string' => 'Поле :attribute не може містити більше ніж :min символів.',
    ],
    'date' => 'Значення поля :attribute не відповідає допустимому формату або не є датою.',
    'date_format' => 'Значення поля :attribute не відповідає необхідному формату - :format.',
    'after_or_equal' => 'Значення поля :attribute повинне бути датою після або рівною :date.',
    'numeric' => 'Поле :attribute не може містити іншого значення, окрім числового.',
    'between' => [
        'numeric' => 'Значення :attribute поля може бути лише числом від :min до :max.',
    ],
    'cyrillic' => 'Поле :attribute приймає лише кирилицю.',
    'boolean' => 'Полю :attribute передане недопутиме значення.',
    'integer' => 'Передане не вірне значення :attribute',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title' => 'Навза',
        'date' => 'Дата',
        'cost_item'=> 'Стаття',
        'sum' => 'Сума',
        'has_cost_items' => 'Містить елементи',
        'cost_item_id' => 'Елемент',
        'cost_direction_id' => 'Стаття'
    ],

];
