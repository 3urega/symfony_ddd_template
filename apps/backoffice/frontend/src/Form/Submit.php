<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Form;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class Submit extends AbstractExtension
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
                'backoffice_form_save_button',
                [
                    $this,
                    'buttonSave',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    public function buttonSave(
        string $label,
        ?string $icon = null,
        ?string $id = null,
        ?string $customClasses = null,
        ?string $formAction = null,
        ?string $buttonName = null
    ): string {
        try {
            return $this->templating->render(
                '@backoffice/form/submit-button.twig',
                [
                    'label' => $label,
                    'id' => $id,
                    'custom_classes' => $customClasses,
                    'form_action' => $formAction,
                    'icon' => $icon,
                    'button_name' => $buttonName,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }
}
