# PHP Validator #
*A PHP validator for French business ID including French VAT validator/calculator*


----------


Authors
- Greg ROUSSAT - https://github.com/Gr3G-RST


----------


This library suits all the needs for a real validation of business ID. 

> composer require gr3grst/php-french-business-id-validator

----------

## Class : Validator

### Methods

#### isSiren

*Validate a SIREN number - 9 digits + Luhn* \
**arguments**\
*string* `$siren` The SIREN number \
**returns**\
*bool* Returns true if the SIRET number is valid, false otherwise. 

#### isSiret

*Validate a SIRET number - 14 digits + Luhn* \
**arguments**\
*string* `$siret` The SIRET number \
**returns**\
*bool* Returns true if the SIRET number is valid, false otherwise.

#### isVatFr

*Validates a French VAT (TVA) number.* \
**arguments**\
*string* $tva The VAT number to validate, which must follow the French format: "FR" + 2 alphanumeric characters + 9 digits. \
**returns**\
*bool* Returns true if the VAT number is valid according to the format and checks, false otherwise.

## Class : Calculator

### Methods

#### calculateVatFr

*Calculates the French VAT (TVA) number based on a given SIREN number.* \
**arguments**\
*string* `$siren` The SIREN number \
**returns**\
*string|false* Returns the computed French VAT number in the format "FR[key][SIREN]" if the input SIREN is valid. Returns false if the SIREN is not valid.
---

