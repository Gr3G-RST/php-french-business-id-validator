# PHP French Business ID Tools #

A set of PHP classes with : \
- Validating for French business ID (SIRET/SIREN)
- Refactoring for French business ID (SIRET/SIREN)
- Calculating French VAT number from SIREN

**Authors**
- Greg ROUSSAT - https://github.com/Gr3G-RST

**Licence** : MIT

## Install ##
> composer require gr3grst/php-french-business-id-validator


## Class : Validator

### Method : isSiren
*Validate a SIREN number - 9 digits + Luhn*

**arguments**\
*string* `$siren` The SIREN number \
**returns**\
*bool* Returns true if the SIRET number is valid, false otherwise. 

### Method : isSiret
*Validate a SIRET number - 14 digits + Luhn*

**arguments**\
*string* `$siret` The SIRET number \
**returns**\
*bool* Returns true if the SIRET number is valid, false otherwise.

### Method : isVatFr
*Validates a French VAT (TVA) number.*

**arguments**\
*string* $tva The VAT number to validate, which must follow the French format: "FR" + 2 alphanumeric characters + 9 digits. \
**returns**\
*bool* Returns true if the VAT number is valid according to the format and checks, false otherwise.

## Class : Calculator

### Method : calculateVatFr
*Calculates the French VAT (TVA) number based on a given SIREN number.* 

**arguments**\
*string* `$siren` The SIREN number \
**returns**\
*string|false* Returns the computed French VAT number in the format "FR[key][SIREN]" if the input SIREN is valid. Returns false if the SIREN is not valid.

## Class : Refactor

### Method : refactorSiren
*Refactor a SIREN number - 9 digits and validate it with Luhn*

**arguments**\
*string* `$siren` The SIREN number to refactor \
**returns**\
*string|false* Returns the SIREN number if valid, false otherwise.

### Method : refactorSiret
*Refactor a SIREN number - 14 digits and validate it with Luhn*

**arguments**\
*string* `$siret` The SIRET number to refactor \
**returns**\
*string|false* Returns the SIRET number if valid, false otherwise.

## Examples ##

```` php
<?php

$test = new Validator();
if ($test->isSiren('string')){ 
    return true;
} else { return false;}
````

