<?php
declare(strict_types=1);

use App\Core\Router;
use App\Controllers\{AuthController, ReportController, CommentController, DashboardController, AdminController};
use App\Middlewares\{AuthMiddleware, AdminMiddleware, AgentMiddleware};

/** @var Router $router */

// ── Public ──────────────────────────────────────────────
$router->get('/',                 [ReportController::class, 'index']);
$router->get('/reports',          [ReportController::class, 'index']);

// ── Authentification ────────────────────────────────────
$router->get('/register',         [AuthController::class, 'showRegister']);
$router->post('/register',        [AuthController::class, 'register']);
$router->get('/login',            [AuthController::class, 'showLogin']);
$router->post('/login',           [AuthController::class, 'login']);
$router->get('/logout',           [AuthController::class, 'logout'], [AuthMiddleware::class]);

// ── Espace utilisateur ──────────────────────────────────
$router->get('/dashboard',        [DashboardController::class, 'index'], [AuthMiddleware::class]);

// ── Signalements (CRUD) ─────────────────────────────────
$router->get('/reports/create',   [ReportController::class, 'create'],  [AuthMiddleware::class]);
$router->post('/reports',         [ReportController::class, 'store'],   [AuthMiddleware::class]);
$router->get('/reports/{id}',     [ReportController::class, 'show']);
$router->get('/reports/{id}/edit',[ReportController::class, 'edit'],    [AuthMiddleware::class]);
$router->post('/reports/{id}/edit',  [ReportController::class, 'update'],  [AuthMiddleware::class]);
$router->post('/reports/{id}/delete',[ReportController::class, 'destroy'], [AuthMiddleware::class]);

// ── Cycle de vie (agent) ────────────────────────────────
$router->post('/reports/{id}/status', [ReportController::class, 'changeStatus'], [AuthMiddleware::class, AgentMiddleware::class]);

// ── Commentaires ────────────────────────────────────────
$router->post('/reports/{reportId}/comments', [CommentController::class, 'store'], [AuthMiddleware::class]);

// ── Administration ──────────────────────────────────────
$router->get('/admin/stats',      [AdminController::class, 'stats'], [AuthMiddleware::class, AdminMiddleware::class]);