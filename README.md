# Aegisora Boolean Rule

![Code Coverage Badge](./badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
![PHPStan Badge](https://img.shields.io/badge/PHPStan-level%209-brightgreen.svg?style=flat)

Boolean Rule provides a simple and strict **boolean value equality validation** for the Aegisora ecosystem.

The package is built on top of `aegisora/rule-contract` and follows its validation architecture, ensuring predictable and safe behavior.

---

## ✨ Features

- 🔹 Minimalistic implementation with no extra dependencies
- 🔹 Strict type validation (`bool` only)
- 🔹 Comparison using `===`
- 🔹 Supports validation for both `true` and `false`
- 🔹 Fully compatible with Aegisora validation pipeline
- 🔹 Clear `Context → Result` flow
- 🔹 No raw booleans — only structured `Result`
- 🔹 Safe execution via base `Rule` abstraction
- 🔹 Convenient factory methods (`createTruthy`, `createFalsy`)
- 🔹 Built-in input validation

---

## 📦 Installation

```shell
composer require aegisora/boolean-rule
```

---

## 🚀 Core Concept

This package performs boolean validation:

- accepts a value via `Context`
- ensures the value is of type `bool`
- compares it with the expected value
- returns a standardized `Result`

Supported values:

- `true`
- `false`

Any other value will result in an exception.

---

## 🏗️ Basic Usage

### ✅ Validate `true`

```php
use Aegisora\Rules\BooleanRule;
use Aegisora\RuleContract\Models\Context;

$result = BooleanRule::createTruthy()->validate(Context::create(true));

if ($result->isValid()) {
    // value is true (as expected)
} else {
    // value is not true
}
```

---

### ❌ Validate `false`

```php
use Aegisora\Rules\BooleanRule;
use Aegisora\RuleContract\Models\Context;

$result = BooleanRule::createFalsy()->validate(Context::create(false));

if ($result->isValid()) {
    // value is false (as expected)
} else {
    // value is not false
}
```

---

## 🧩 Factory Methods

```php
BooleanRule::createTruthy();
BooleanRule::createFalsy();
```

- `createTruthy()` — expects `true`
- `createFalsy()` — expects `false`

---

## ⚠️ Validation Rules

The input value must strictly be a boolean:

- `true`
- `false`

Any other type (`int`, `string`, `null`, etc.) will throw an exception:

`Aegisora\RuleContract\Exceptions\InvalidRuleContextException`

---

## 🏛️ Architecture

This package relies on `aegisora/rule-contract`.

Validation flow:

1. `validate()` is called
2. `Context` is passed
3. `executeValidate()` is executed
4. Value type is validated (`bool` only)
5. Strict comparison (`===`) is performed
6. A `Result` is returned

All logic is encapsulated within the base `Rule` abstraction.

---