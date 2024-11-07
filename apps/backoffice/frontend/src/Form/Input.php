<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Form;

use Eurega\Shared\Infrastructure\Symfony\Request\FrontendRequest;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function Symfony\Component\String\u;

final class Input extends AbstractExtension
{
    private Environment $templating;

    public function __construct(Environment $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'backoffice_form_input_text',
                [
                    $this,
                    'text',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_input_number',
                [
                    $this,
                    'number',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_input_password',
                [
                    $this,
                    'password',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_select',
                [
                    $this,
                    'select',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_textarea',
                [
                    $this,
                    'textarea',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_checkbox',
                [
                    $this,
                    'checkbox',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_radio',
                [
                    $this,
                    'radio',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_file',
                [
                    $this,
                    'file',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    public function text(
        FrontendRequest $request,
        string $label,
        string $property,
        ?string $id = null,
        ?bool $required = false,
        ?string $type = 'text',
        ?string $placeholder = null,
        ?string $extraClasses = null,
        ?string $inputAppend = null,
        ?string $helpBlock = null,
        ?bool $readonly = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/input-text.twig',
                [
                    'form_label' => $label,
                    'form_input_type' => $type,
                    'form_input_placeholder' => $placeholder,
                    'form_input_value' => $request->{$propertyCamel},
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'form_help_block' => $helpBlock,
                    'readonly' => $readonly,
                    'form_input_extra_classes' => $extraClasses,
                    'required' => $required,
                    'input_append' => $inputAppend,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function number(
        FrontendRequest $request,
        string $label,
        string $property,
        ?string $id = null,
        ?bool $required = false,
        ?int $min = null,
        ?int $max = null,
        ?bool $decimals = false,
        ?string $placeholder = null,
        ?string $extraClasses = null,
        ?string $inputAppend = null,
        ?string $helpBlock = null,
        ?bool $readonly = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/input-text.twig',
                [
                    'form_label' => $label,
                    'form_input_type' => 'number',
                    'form_input_placeholder' => $placeholder,
                    'form_input_value' => $request->{$propertyCamel},
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'min' => $min,
                    'max' => $max,
                    'decimals' => $decimals,
                    'form_help_block' => $helpBlock,
                    'readonly' => $readonly,
                    'form_input_extra_classes' => $extraClasses,
                    'required' => $required,
                    'input_append' => $inputAppend,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    /**
     * @param FrontendRequest $request
     * @param string $label
     * @param string $property
     * @param string|null $id
     * @param bool $required
     * @param string|null $placeHolder
     * @param string|null $helpBlock
     * @return string
     */
    public function password(
        FrontendRequest $request,
        string $label,
        string $property,
        $id = null,
        $required = false,
        $placeHolder = null,
        $helpBlock = null
    ) {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/password.twig',
                [
                    'form_label' => $label,
                    'form_input_type' => 'password',
                    'form_input_placeholder' => $placeHolder,
                    'form_input_value' => $request->{$propertyCamel},
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($property),
                    'form_input_id' => $id,
                    'form_help_block' => $helpBlock,
                    'required' => $required,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function select(
        FrontendRequest $request,
        string $label,
        string $property,
        ?string $id = null,
        ?array $options = null,
        ?bool $required = false,
        ?string $placeholder = null,
        ?string $extraClasses = null,
        ?string $helpBlock = null,
        ?bool $readonly = false,
        ?bool $multiple = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/select.twig',
                [
                    'form_label' => $label,
                    'form_input_placeholder' => $placeholder,
                    'form_input_value' => $request->{$propertyCamel},
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'form_help_block' => $helpBlock,
                    'options' => $options,
                    'readonly' => $readonly,
                    'form_input_extra_classes' => $extraClasses,
                    'required' => $required,
                    'multiple' => $multiple,
                ]
            );
        } catch (LoaderError $e) {
            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }

        return '';
    }

    public function textarea(
        FrontendRequest $request,
        string $property,
        ?string $id = null,
        ?string $label = null,
        ?bool $required = false,
        ?string $placeholder = null,
        ?string $extraClasses = null,
        ?string $helpBlock = null,
        ?bool $readonly = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/textarea.twig',
                [
                    'form_label' => $label,
                    'form_input_type' => 'text',
                    'form_input_placeholder' => $placeholder,
                    'form_input_value' => $request->{$propertyCamel},
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'form_help_block' => $helpBlock,
                    'readonly' => $readonly,
                    'form_input_extra_classes' => $extraClasses,
                    'required' => $required,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function checkbox(
        FrontendRequest $request,
        string $label,
        string $property,
        ?string $id = null,
        ?bool $required = false,
        ?bool $checked = false,
        ?string $classes = null,
        ?bool $readonly = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/checkbox.twig',
                [
                    'form_label' => $label,
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'checked' => $checked || $request->{$propertyCamel},
                    'required' => $required,
                    'classes' => $classes,
                    'readonly' => $readonly,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function radio(
        FrontendRequest $request,
        string $label,
        string $property,
        string $value,
        ?string $id = null,
        ?bool $required = false,
        ?bool $checked = false,
        ?string $classes = null,
        ?bool $readonly = false
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/radio.twig',
                [
                    'form_label' => $label,
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'checked' => $checked || $request->{$propertyCamel} === $value,
                    'value' => $value,
                    'required' => $required,
                    'classes' => $classes,
                    'readonly' => $readonly,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function file(
        FrontendRequest $request,
        string $label,
        string $property,
        ?string $id = null,
        ?bool $hidden = false,
        ?bool $accept = null,
        ?bool $multiple = false,
        ?string $helpBlock = null
    ): string {
        $propertyCamel = (string) u($property)->camel();

        try {
            return $this->templating->render(
                '@backoffice/form/file.twig',
                [
                    'form_label' => $label,
                    'form_input_name' => $property,
                    'form_input_error' => $request->error($propertyCamel),
                    'form_input_id' => $id ?? $property,
                    'accept' => $accept,
                    'multiple' => $multiple,
                    'form_help_block' => $helpBlock,
                    'hidden' => $hidden
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }
}
