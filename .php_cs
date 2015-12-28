<?php

/**
 * The list of fixers is inspired by the ones used by Zend at:
 *
 *  https://github.com/zendframework/modules.zendframework.com/blob/master/.php_cs
 */

$config = new Symfony\CS\Config\Config();

$config->getFinder()
        ->exclude('vendor')
        ->exclude('test')
        ->exclude('test-coverage')
        ->in(__DIR__);

return $config->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
                ->setUsingCache(true)
                ->fixers([
                    'align_double_arrow',
                    'align_equals',
                    'concat_with_spaces',
                    // 'empty_return',
                    // 'double_arrow_multiline_whitespaces',
                    'duplicate_semicolon',
                    'extra_empty_lines',
                    'include',
                    'join_function',
                    'linefeed',
                    // 'multiline_spaces_before_semicolon',
                    'multiline_array_trailing_comma',
                    'namespace_no_leading_whitespace',
                    'new_with_braces',
                    'no_blank_lines_after_class_opening',
                    'no_empty_lines_after_phpdocs',
                    'object_operator',
                    'operators_spaces',
                    'ordered_use',
                    // 'phpdoc_indent',
                    // 'phpdoc_params',
                    'remove_leading_slash_use',
                    'remove_lines_between_uses',
                    'return',
                    'short_array_syntax',
                    'single_array_no_trailing_comma',
                    'spaces_before_semicolon',
                    'spaces_cast',
                    'standardize_not_equal',
                    'ternary_spaces',
                    'unused_use',
                    'whitespacy_lines',
                ]);
