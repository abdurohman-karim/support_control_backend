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

    'accepted'             => ':attribute tasdiqlangan bo‘lishi kerak.',
    'active_url'           => ':attribute noto‘g‘ri URL formatida.',
    'after'                => ':attribute :date dan keyin bo‘lishi kerak.',
    'after_or_equal'       => ':attribute :date ga teng yoki undan keyin bo‘lishi kerak.',
    'alpha'                => ':attribute faqat harflarni qabul qilishi mumkin.',
    'alpha_dash'           => ':attribute faqat harflar, sonlar, chiziqlar va pastki chiziqlarni qabul qilishi mumkin.',
    'alpha_num'            => ':attribute faqat harflar va sonlarni qabul qilishi mumkin.',
    'array'                => ':attribute ro‘yxat bo‘lishi kerak.',
    'before'               => ':attribute :date gachasi bo‘lishi kerak.',
    'before_or_equal'      => ':attribute :date ga teng yoki undan oldin bo‘lishi kerak.',
    'between'              => [
        'numeric' => ':attribute :min va :max oralig‘ida bo‘lishi kerak.',
        'file'    => ':attribute hajmi :min va :max kilobayt oralig‘ida bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :min va :max belgi oralig‘ida bo‘lishi kerak.',
        'array'   => ':attribute elementlar soni :min va :max oralig‘ida bo‘lishi kerak.',
    ],
    'boolean'              => ':attribute maydoni faqat mantiqiy qiymatlarni qabul qilishi mumkin.',
    'confirmed'            => ':attribute tasdiqlash mos kelmayapti.',
    'date'                 => ':attribute noto‘g‘ri sana formatida.',
    'date_equals'          => ':attribute :date ga teng bo‘lishi kerak.',
    'date_format'          => ':attribute :format formatiga mos kelmaydi.',
    'different'            => ':attribute va :other bir-biri bilan farqli bo‘lishi kerak.',
    'digits'               => ':attribute :digits xona bo‘lishi kerak.',
    'digits_between'       => ':attribute uzunligi :min va :max oralig‘ida bo‘lishi kerak.',
    'dimensions'           => ':attribute tasvir o‘lchamlari noto‘g‘ri.',
    'distinct'             => ':attribute maydoni takrorlanuvchi qiymatlardan iborat.',
    'email'                => ':attribute noto‘g‘ri elektron pochta manzilida.',
    'ends_with'            => ':attribute quyidagilardan biri bilan tugayishi kerak: :values.',
    'exists'               => 'Tanlangan :attribute xato.',
    'file'                 => ':attribute fayl bo‘lishi kerak.',
    'filled'               => ':attribute maydoni to‘ldirilishi kerak.',
    'gt'                   => [
        'numeric' => ':attribute :value dan katta bo‘lishi kerak.',
        'file'    => ':attribute hajmi :value kilobaytdan katta bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :value belgidan katta bo‘lishi kerak.',
        'array'   => ':attribute :value tadan ko‘p elementga ega bo‘lishi kerak.',
    ],
    'gte'                  => [
        'numeric' => ':attribute :value dan katta yoki teng bo‘lishi kerak.',
        'file'    => ':attribute hajmi :value kilobaytdan katta yoki teng bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :value belgidan katta yoki teng bo‘lishi kerak.',
        'array'   => ':attribute kamida :value tadan ko‘p elementga ega bo‘lishi kerak.',
    ],
    'image'                => ':attribute rasm bo‘lishi kerak.',
    'in'                   => 'Tanlangan :attribute to‘g‘ri emas.',
    'in_array'             => ':attribute :other da mavjud emas.',
    'integer'              => ':attribute butun son bo‘lishi kerak.',
    'ip'                   => ':attribute haqiqiy IP manzil bo‘lishi kerak.',
    'ipv4'                 => ':attribute haqiqiy IPv4 manzil bo‘lishi kerak.',
    'ipv6'                 => ':attribute haqiqiy IPv6 manzil bo‘lishi kerak.',
    'json'                 => ':attribute JSON qiymat bo‘lishi kerak.',
    'lt'                   => [
        'numeric' => ':attribute :value dan kichik bo‘lishi kerak.',
        'file'    => ':attribute hajmi :value kilobaytdan kichik bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :value belgidan kichik bo‘lishi kerak.',
        'array'   => ':attribute :value tadan kam elementga ega bo‘lishi kerak.',
    ],
    'lte'                  => [
        'numeric' => ':attribute :value dan kichik yoki teng bo‘lishi kerak.',
        'file'    => ':attribute hajmi :value kilobaytdan kichik yoki teng bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :value belgidan kichik yoki teng bo‘lishi kerak.',
        'array'   => ':attribute :value tadan kam yoki teng elementga ega bo‘lishi kerak.',
    ],
    'max'                  => [
        'numeric' => ':attribute :max dan katta bo‘lishi mumkin emas.',
        'file'    => ':attribute hajmi :max kilobaytdan katta bo‘lishi mumkin emas.',
        'string'  => ':attribute uzunligi :max belgidan katta bo‘lishi mumkin emas.',
        'array'   => ':attribute :max tadan ko‘p elementga ega bo‘lishi mumkin emas.',
    ],
    'max'                  => [
        'numeric' => ':attribute maydoni :max dan katta bo‘lmasligi kerak.',
        'file'    => ':attribute hajmi :max kilobaytdan katta bo‘lmasligi kerak.',
        'string'  => ':attribute uzunligi :max belgidan katta bo‘lmasligi kerak.',
        'array'   => ':attribute tarkibi :max elementdan ko‘p bo‘lmasligi kerak.',
    ],
    'mimes'                => ':attribute fayl turining quyidagi tiplaridan biri bo‘lishi kerak: :values.',
    'mimetypes'            => ':attribute fayl turining quyidagi tiplaridan biri bo‘lishi kerak: :values.',
    'min'                  => [
        'numeric' => ':attribute maydoni :min dan katta bo‘lishi kerak.',
        'file'    => ':attribute hajmi :min kilobaytdan katta bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :min belgidan katta bo‘lishi kerak.',
        'array'   => ':attribute tarkibi kamida :min elementga ega bo‘lishi kerak.',
    ],
    'not_in'               => 'Tanlangan :attribute to‘g‘ri emas.',
    'not_regex'            => ':attribute formati noto‘g‘ri.',
    'numeric'              => ':attribute raqam bo‘lishi kerak.',
    'password'             => 'Noto‘g‘ri parol.',
    'present'              => ':attribute maydoni mavjud bo‘lishi kerak.',
    'regex'                => ':attribute formati noto‘g‘ri.',
    'required'             => ':attribute maydoni to‘ldirilishi kerak.',
    'required_if'          => ':attribute maydoni, :other qiymati :value bo‘lgan paytda to‘ldirilishi kerak.',
    'required_unless'      => ':attribute maydoni, :other qiymati :values ga teng bo‘lgan paytda to‘ldirilishi kerak.',
    'required_with'        => ':attribute maydoni :values jadvallari mavjud bo‘lgan paytda to‘ldirilishi kerak.',
    'required_with_all'    => ':attribute maydoni :values jadvallari mavjud bo‘lgan paytda to‘ldirilishi kerak.',
    'required_without'     => ':attribute maydoni :values jadvallari mavjud emas bo‘lgan paytda to‘ldirilishi kerak.',
    'required_without_all' => ':attribute maydoni hech qachon :values jadvallari mavjud emas bo‘lgan paytda to‘ldirilishi kerak.',
    'same'                 => ':attribute va :other bir xil bo‘lishi kerak.',
    'size'                 => [
        'numeric' => ':attribute hajmi :size bo‘lishi kerak.',
        'file'    => ':attribute hajmi :size kilobayt bo‘lishi kerak.',
        'string'  => ':attribute uzunligi :size belgidan iborat bo‘lishi kerak.',
        'array'   => ':attribute tarkibi :size elementga teng bo‘lishi kerak.',
    ],
    'starts_with'          => ':attribute quyidagi qiymatlardan biri bilan boshlanishi kerak: :values.',
    'string'               => ':attribute matn bo‘lishi kerak.',
    'timezone'             => ':attribute to‘g‘ri mintaqaga mansub bo‘lishi kerak.',
    'unique'               => ':attribute avvalroq band qilingan.',
    'uploaded'             => ':attribute yuklash muvaffaqiyatsiz yakunlandi.',
    'url'                  => ':attribute noto‘g‘ri formatga ega.',
    'uuid'                 => ':attribute noto‘g‘ri UUID ga ega.',

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

    'attributes' => [],

];
