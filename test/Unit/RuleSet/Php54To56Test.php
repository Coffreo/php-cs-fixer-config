<?php

/**
 * This file is part of Coffreo project "coffreo-toolbox/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved
 *
 * This source file is subject to the proprietary license.
 */

namespace Coffreo\PhpCsFixer\Config\Test\Unit\RuleSet;

use Coffreo\PhpCsFixer\Config\RuleSet\Php54To56;

final class Php54To56Test extends AbstractRuleSetTestCase
{
    protected function className()
    {
        return Php54To56::class;
    }

    protected function name()
    {
        return 'Coffreo (PHP 5.4 to PHP 5.6)';
    }

    protected function targetPhpCsFixer()
    {
        return '2.2.';
    }

    protected function rules()
    {
        return [
            '@PHP56Migration' => true,
            'array_syntax' => false,
            'binary_operator_spaces' => false,
            'blank_line_after_namespace' => false,
            'blank_line_after_opening_tag' => false,
            'blank_line_before_return' => false,
            'braces' => false,
            'cast_spaces' => false,
            'class_definition' => false,
            'class_keyword_remove' => false,
            'combine_consecutive_unsets' => false,
            'concat_space' => false,
            'declare_equal_normalize' => false,
            'declare_strict_types' => false,
            'dir_constant' => false,
            'doctrine_annotation_braces' => false,
            'doctrine_annotation_indentation' => false,
            'doctrine_annotation_spaces' => false,
            'elseif' => false,
            'encoding' => false,
            'ereg_to_preg' => false,
            'full_opening_tag' => false,
            'function_declaration' => false,
            'function_to_constant' => false,
            'function_typehint_space' => false,
            'general_phpdoc_annotation_remove' => false,
            'hash_to_slash_comment' => false,
            'header_comment' => false,
            'heredoc_to_nowdoc' => false,
            'include' => false,
            'indentation_type' => false,
            'is_null' => false,
            'line_ending' => false,
            'linebreak_after_opening_tag' => false,
            'lowercase_cast' => false,
            'lowercase_constants' => false,
            'lowercase_keywords' => false,
            'magic_constant_casing' => false,
            'mb_str_functions' => false,
            'method_argument_space' => false,
            'method_separation' => false,
            'modernize_types_casting' => false,
            'native_function_casing' => false,
            'native_function_invocation' => false,
            'new_with_braces' => false,
            'no_alias_functions' => false,
            'no_blank_lines_after_class_opening' => false,
            'no_blank_lines_after_phpdoc' => false,
            'no_blank_lines_before_namespace' => false,
            'no_closing_tag' => false,
            'no_empty_comment' => false,
            'no_empty_phpdoc' => false,
            'no_empty_statement' => false,
            'no_extra_consecutive_blank_lines' => false,
            'no_leading_import_slash' => false,
            'no_leading_namespace_whitespace' => false,
            'no_mixed_echo_print' => false,
            'no_multiline_whitespace_around_double_arrow' => false,
            'no_multiline_whitespace_before_semicolons' => false,
            'no_php4_constructor' => false,
            'no_short_bool_cast' => false,
            'no_short_echo_tag' => false,
            'no_singleline_whitespace_before_semicolons' => false,
            'no_spaces_after_function_name' => false,
            'no_spaces_around_offset' => false,
            'no_spaces_inside_parenthesis' => false,
            'no_trailing_comma_in_list_call' => false,
            'no_trailing_comma_in_singleline_array' => false,
            'no_trailing_whitespace' => false,
            'no_trailing_whitespace_in_comment' => false,
            'no_unneeded_control_parentheses' => false,
            'no_unreachable_default_argument_value' => false,
            'no_unused_imports' => false,
            'no_useless_else' => false,
            'no_useless_return' => false,
            'no_whitespace_before_comma_in_array' => false,
            'no_whitespace_in_blank_line' => false,
            'non_printable_character' => false,
            'normalize_index_brace' => false,
            'not_operator_with_space' => false,
            'not_operator_with_successor_space' => false,
            'object_operator_without_whitespace' => false,
            'ordered_class_elements' => false,
            'ordered_imports' => false,
            'php_unit_construct' => false,
            'php_unit_dedicate_assert' => false,
            'php_unit_fqcn_annotation' => false,
            'php_unit_strict' => false,
            'phpdoc_add_missing_param_annotation' => false,
            'phpdoc_align' => false,
            'phpdoc_annotation_without_dot' => false,
            'phpdoc_indent' => false,
            'phpdoc_inline_tag' => false,
            'phpdoc_no_access' => false,
            'phpdoc_no_alias_tag' => false,
            'phpdoc_no_empty_return' => false,
            'phpdoc_no_package' => false,
            'phpdoc_no_useless_inheritdoc' => false,
            'phpdoc_order' => false,
            'phpdoc_return_self_reference' => false,
            'phpdoc_scalar' => false,
            'phpdoc_separation' => false,
            'phpdoc_single_line_var_spacing' => false,
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => false,
            'phpdoc_trim' => false,
            'phpdoc_types' => false,
            'phpdoc_var_without_name' => false,
            'pre_increment' => false,
            'protected_to_private' => false,
            'psr0' => false,
            'psr4' => false,
            'random_api_migration' => false,
            'return_type_declaration' => false,
            'self_accessor' => false,
            'semicolon_after_instruction' => false,
            'short_scalar_cast' => false,
            'silenced_deprecation_error' => false,
            'simplified_null_return' => false,
            'single_blank_line_at_eof' => false,
            'single_blank_line_before_namespace' => false,
            'single_class_element_per_statement' => false,
            'single_import_per_statement' => false,
            'single_line_after_imports' => false,
            'single_quote' => false,
            'space_after_semicolon' => false,
            'standardize_not_equals' => false,
            'strict_comparison' => false,
            'strict_param' => false,
            'switch_case_semicolon_to_colon' => false,
            'switch_case_space' => false,
            'ternary_operator_spaces' => false,
            'ternary_to_null_coalescing' => false,
            'trailing_comma_in_multiline_array' => false,
            'trim_array_spaces' => false,
            'unary_operator_spaces' => false,
            'visibility_required' => false,
            'whitespace_after_comma_in_array' => false,
        ];
    }

    protected function targetPhpVersion()
    {
        return 50400;
    }
}
