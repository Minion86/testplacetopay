# Security remediation — 2026-10-16

Updated dnetix/redirection and its HTTP dependencies within the existing SDK range. Guzzle moves from 6 to 7 through the SDK supported dependency constraints. Validated dependency installation, request construction and payment SDK autoload using PHP 8.3 plus SOAP. No payments or remote payment API calls were made.

Composer audit reports no vulnerable dependencies in the updated lockfile. Removed tracked Composer vendor dependencies so a clean deployment must run `composer install --no-dev --prefer-dist` in /test before serving the application. The dependency scan does not certify application code or bundled third-party assets.
