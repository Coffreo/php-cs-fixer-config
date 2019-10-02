<?php

/**
 * This file is part of Coffreo project "coffreo/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\PhpCsFixer\Config\RuleSet;

final class Php56 extends AbstractRuleSet
{
    protected $name = 'Coffreo (PHP 5.6)';

    protected $rules = [
        '@Symfony' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'class_keyword_remove' => false,
        'combine_consecutive_unsets' => true,
        'declare_strict_types' => false,
        'dir_constant' => false,
        'doctrine_annotation_braces' => [
            'syntax' => 'without_braces',
        ],
        'doctrine_annotation_indentation' => true,
        'doctrine_annotation_spaces' => true,
        'ereg_to_preg' => false,
        'function_to_constant' => false,
        'general_phpdoc_annotation_remove' => false,
        'header_comment' => false,
        'heredoc_to_nowdoc' => false,
        'is_null' => [
            'use_yoda_style' => true,
        ],
        'linebreak_after_opening_tag' => true,
        'list_syntax' => false,
        'mb_str_functions' => false,
        'modernize_types_casting' => true,
        'native_function_invocation' => false,
        'no_alias_functions' => false,
        'no_blank_lines_before_namespace' => false,
        'no_multiline_whitespace_before_semicolons' => true,
        'no_php4_constructor' => false,
        'no_short_echo_tag' => true,
        'no_unreachable_default_argument_value' => true,        // remove legacy
        'no_useless_else' => true,
        'no_useless_return' => true,
        'non_printable_character' => true,                      // remove legacy
        'not_operator_with_space' => false,
        'not_operator_with_successor_space' => false,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'php_unit_construct' => false,
        'php_unit_dedicate_assert' => false,
        'php_unit_strict' => false,
        'php_unit_test_class_requires_covers' => false,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => false,
        ],
        'phpdoc_order' => true,
        'pow_to_exponentiation' => true,
        'psr0' => false,
        'psr4' => false,
        'random_api_migration' => false,
        'semicolon_after_instruction' => true,
        'silenced_deprecation_error' => false,
        'simplified_null_return' => false,
        'strict_comparison' => false,
        'strict_param' => false,
        'ternary_to_null_coalescing' => false,
        'visibility_required' => [
            'method',
            'property',
        ],
    ];

    protected $targetPhpVersion = 50600;
}
