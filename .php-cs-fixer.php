<?php

declare(strict_types=1);

return (new \PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer'                => true,
        '@PhpCsFixer:risky'          => true,
        '@PHP80Migration'            => true,
        '@PHP80Migration:risky'      => true,
        'mb_str_functions'           => true,
        'native_function_invocation' => false,
        'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],
        'php_unit_internal_class'    => false,
        'phpdoc_separation'          => false,
        'increment_style'            => ['style' => 'post'],
        'php_unit_method_casing'     => ['case' => 'snake_case'],
        'php_unit_test_annotation'   => ['style' => 'annotation'],
        'phpdoc_align'               => ['align' => 'left'],
        'phpdoc_types_order'         => [
            'null_adjustment' => 'always_last',
            'sort_algorithm'  => 'alpha',
        ],
        'ordered_imports' => [
            'imports_order'  => ['class', 'function', 'const'],
            'sort_algorithm' => 'alpha',
        ],
        'binary_operator_spaces' => [
            'operators' => [
                '|'  => 'no_space',
                '=>' => 'align_single_space_minimal',
            ],
        ],
        'yoda_style' => [
            'equal'            => true,
            'identical'        => false,
            'less_and_greater' => null,
        ],
        'not_operator_with_successor_space'      => true,
        'php_unit_test_class_requires_covers'    => false,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'this'],
    ])
    ->setFinder(
        \PhpCsFixer\Finder::create()
            ->in(__DIR__.'/lib')
            ->in(__DIR__.'/tests')
    )
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
;