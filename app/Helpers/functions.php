<?php
declare(strict_types=1);

use App\Core\Session;
use App\Services\AuthService;
use App\Models\Entities\User;

/** Échappement HTML systématique des sorties. */
function e(?string $v): string { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }

/** URL absolue basée sur le sous-dossier d'installation. */
function url(string $path = ''): string
{
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php'), '/');
    return $base . '/' . ltrim($path, '/');
}

/** Utilisateur connecté (ou null). */
function current_user(): ?User { return (new AuthService())->currentUser(); }
function is_logged_in(): bool { return Session::has('user_id'); }

/** Jeton CSRF. */
function csrf_token(): string
{
    if (!Session::has('_csrf')) {
        Session::set('_csrf', bin2hex(random_bytes(32)));
    }
    return Session::get('_csrf');
}
function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}
function csrf_check(?string $token): bool
{
    return is_string($token) && hash_equals(Session::get('_csrf', ''), $token);
}

/** Valeur ré-affichée après une erreur de formulaire. */
function old(string $key, string $default = ''): string
{
    return e($_SESSION['_old'][$key] ?? $default);
}
