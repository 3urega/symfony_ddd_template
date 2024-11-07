<?php

namespace Eurega\Shared\Infrastructure\Symfony\Logger;

use Symfony\Component\HttpFoundation\RequestStack;

final class CorrelationIdProcessor {
    public function __construct(
        private RequestStack $requestStack
    ) { }

    public function __invoke(array $record) {
        $request = $this->requestStack->getMainRequest();
        if(!$request->headers->has('X-CID')) {
            return $record;
        }

        $record['extra']['correlation_id'] = $request->headers->get('X-CID');

        return $record;
    }
}