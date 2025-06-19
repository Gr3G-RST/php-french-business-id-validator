<?php

namespace gr3grst;

/**
 * A utility class for validating various types of French business identifiers
 * such as SIREN, SIRET, and VAT (TVA) numbers.
 */
class Validator {

    /**
     * Validates if the provided SIREN number is valid using the Luhn algorithm.
     *
     * @param string $siren The SIREN number as a string consisting of 9 digits.
     * @return bool Returns true if the SIREN number is valid, false otherwise.
     */
    static function isSiren($siren) {
        if (!preg_match('/^\d{9}$/', $siren)) {
            return false;
        }
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $digit = (int)$siren[$i];
            if ($i % 2 === 1) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        return $sum % 10 === 0;
    }

    /**
     * Validates a SIRET number using the Luhn algorithm.
     *
     * @param string $siret The SIRET number to validate, which must be a 14-digit string.
     * @return bool Returns true if the SIRET number is valid, false otherwise.
     */
    static function isSiret($siret) {
        if (!preg_match('/^\d{14}$/', $siret)) {
            return false;
        }
        $sum = 0;
        for ($i = 0; $i < 14; $i++) {
            $digit = (int)$siret[$i];
            if ($i % 2 === 1) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        return $sum % 10 === 0;
    }

    /**
     * Validates a French VAT (TVA) number.
     *
     * @param string $tva The VAT number to validate, which must follow the French format: "FR" + 2 alphanumeric characters + 9 digits.
     * @return bool Returns true if the VAT number is valid according to the format and checks, false otherwise.
     */
    static function isVatFr($tva) {
        // Supprime les espaces et met en majuscules
        $tva = strtoupper(str_replace([' ', '-', '.', ','], '', $tva));

        // Vérifie le format : FR + 2 caractères + 9 chiffres
        if (!preg_match('/^FR([A-Z0-9]{2})(\d{9})$/', $tva, $matches)) {
            return false;
        }

        $cle = $matches[1];
        $siren = $matches[2];

        // Vérifie que le SIREN est valide
        if (!isSiren($siren)) {
            return false;
        }

        // Calcule la clé attendue
        $sirenInt = (int)$siren;
        $calcKey = (12 + 3 * ($sirenInt % 97)) % 97;

        // Vérifie la clé : si elle est numérique
        if (ctype_digit($key)) {
            return (int)$key === $calcKey;
        }

        // Si la clé contient des lettres, il faut une table de conversion personnalisée (très rare, mais possible)
        return false;
    }

}

/**
 * A utility class for performing calculations related to French business numbers, including VAT (TVA)
 * number computation based on SIREN validation.
 */
class Calculator {
    /**
     * Calculates the French VAT (TVA) number based on a given SIREN number.
     *
     * @param string $siren The SIREN number to compute the French VAT number for. The input can contain spaces,
     *                      dashes, dots, or commas, which will be removed.
     *
     * @return string|false Returns the computed French VAT number in the format "FR[cle][SIREN]"
     *                      if the input SIREN is valid. Returns false if the SIREN is not valid.
     */
    static function calculateVatFr($siren) {
        // Supprime les espaces, tirest, ...
        $siren = str_replace([' ', '-', '.', ','], '', $siren);
        // Vérifie que le SIREN est valide
        if (!isSiren($siren)) {
            return false;
        }

        // Calcule la clé attendue
        $sirenInt = (int)$siren;
        $key = (12 + 3 * ($sirenInt % 97)) % 97;
        // Vérifie la clé : si elle est numérique
        if (ctype_digit($key)) {
            return 'FR'.$key.$siren;
        }
    }
}
