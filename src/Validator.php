<?php

namespace gr3grst;

/**
 * A PHP validator for French business ID
 * It also include classes for checking / calculating VAT Number
 * @author Greg ROUSSAT https://github.com/Gr3G-RST
 */
class Validator {

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

    static function isTvaFR($tva) {
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
        $cleCalculée = (12 + 3 * ($sirenInt % 97)) % 97;

        // Vérifie la clé : si elle est numérique
        if (ctype_digit($cle)) {
            return (int)$cle === $cleCalculée;
        }

        // Si la clé contient des lettres, il faut une table de conversion personnalisée (très rare, mais possible)
        return false;
    }

}
