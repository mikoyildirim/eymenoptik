<?php

return [
    'accepted' => ':attribute kabul edilmelidir.',
    'array' => ':attribute alanı bir dizi olmalıdır.',
    'boolean' => ':attribute alanı true ya da false olmalıdır.',
    'confirmed' => ':attribute doğrulaması eşleşmiyor.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'integer' => ':attribute alanı bir tam sayı olmalıdır.',
    'max' => [
        'numeric' => ':attribute en fazla :max olmalıdır.',
        'file' => ':attribute en fazla :max kilobayt olmalıdır.',
        'string' => ':attribute en fazla :max karakter olmalıdır.',
        'array' => ':attribute en fazla :max öğe içermelidir.',
    ],
    'min' => [
        'numeric' => ':attribute en az :min olmalıdır.',
        'file' => ':attribute en az :min kilobayt olmalıdır.',
        'string' => ':attribute en az :min karakter olmalıdır.',
        'array' => ':attribute en az :min öğe içermelidir.',
    ],
    'required' => ':attribute alanı zorunludur.',
    'string' => ':attribute alanı metin olmalıdır.',
    'unique' => 'Bu :attribute zaten kayıtlı.',

    'attributes' => [
        'name' => 'ad soyad',
        'email' => 'e-posta',
        'password' => 'şifre',
        'password_confirmation' => 'şifre tekrar',
    ],
];
