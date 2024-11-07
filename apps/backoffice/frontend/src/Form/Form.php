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

final class Form extends AbstractExtension
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
                'backoffice_form_start',
                [
                    $this,
                    'start',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_start_multipart',
                [
                    $this,
                    'startMultipart',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
            new TwigFunction(
                'backoffice_form_end',
                [
                    $this,
                    'end',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    public function start(
        ?string $id = null,
        ?string $action = null,
        ?string $classes = null,
        ?bool $isMultipart = false,
        ?string $method = 'POST'
    ): string {
        try {
            return $this->templating->render(
                '@backoffice/form/start.twig',
                [
                    'id' => $id,
                    'action' => $action,
                    'classes' => $classes,
                    'multipart' => $isMultipart,
                    'method' => $method,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }

    public function startMultipart(
        ?string $id = null,
        ?string $action = null,
        ?string $classes = null
    ): string {
        return $this->start($id, $action, $classes, true);
    }

    public function end(FrontendRequest $request): string
    {
        try {
            return $this->templating->render(
                '@backoffice/form/end.twig',
                [
                    'token_name' => $request::class,
                ]
            );
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }

        return '';
    }
}
