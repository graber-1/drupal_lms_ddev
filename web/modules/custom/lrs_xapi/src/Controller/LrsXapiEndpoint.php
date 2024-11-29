<?php

declare(strict_types=1);

namespace Drupal\lrs_xapi\Controller;

use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LrsXapiEndpoint {

  public function activities(string $statement_type, Request $request): Response {
    $this->logRequest($request);
    return new Response('OK');
  }

  public function statements(string $statement_type, Request $request): Response {
    $this->logRequest($request);
    kdpm($statement_type, 'FA');
    kdpm($request->query->all(), 'FA1');
    kdpm((string) $request, 'FA1');
    return new Response('OK');
  }

  private function logRequest(Request $request) {
    $fh = \fopen('requests.txt', 'a');
    \fwrite($fh, PHP_EOL . PHP_EOL . (string) $request);
  }

}
