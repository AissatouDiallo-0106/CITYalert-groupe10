-- ════════════════════════════════════════════════════════════
-- CityAlert — Données de démonstration
-- Mot de passe de tous les comptes : password
-- ════════════════════════════════════════════════════════════
USE cityalert;

INSERT INTO users (name, email, password_hash, role) VALUES
('Admin CityAlert', 'admin@cityalert.sn', '$2b$10$afA3fyygQcg0bgTNHii.YeAtJXC0h50rGF.JoG6uH6qB.asWALrgK', 'ADMIN'),
('Agent Voirie',    'agent@cityalert.sn', '$2b$10$afA3fyygQcg0bgTNHii.YeAtJXC0h50rGF.JoG6uH6qB.asWALrgK', 'AGENT'),
('Awa Diop',        'awa@cityalert.sn',   '$2b$10$afA3fyygQcg0bgTNHii.YeAtJXC0h50rGF.JoG6uH6qB.asWALrgK', 'CITOYEN'),
('Modou Fall',      'modou@cityalert.sn', '$2b$10$afA3fyygQcg0bgTNHii.YeAtJXC0h50rGF.JoG6uH6qB.asWALrgK', 'CITOYEN');

INSERT INTO reports (title, description, category, address, author_id, status) VALUES
('Nid-de-poule dangereux', 'Un grand trou sur la chaussée provoque des accidents près de l''école.', 'VOIRIE', 'Avenue Bourguiba, Dakar', 3, 'NOUVEAU'),
('Lampadaire éteint', 'Plusieurs lampadaires ne fonctionnent plus depuis une semaine, rue très sombre.', 'ECLAIRAGE', 'Rue 10, Médina', 4, 'EN_COURS'),
('Dépôt sauvage d''ordures', 'Accumulation de déchets au coin de la rue, mauvaises odeurs.', 'DECHETS', 'Marché Castors', 3, 'RESOLU'),
('Fuite d''eau importante', 'Une conduite fuit et inonde le trottoir depuis ce matin.', 'EAU', 'Liberté 6', 4, 'NOUVEAU');

INSERT INTO status_history (report_id, agent_id, status, comment) VALUES
(2, 2, 'EN_COURS', 'Intervention planifiée.'),
(3, 2, 'EN_COURS', 'Équipe envoyée sur place.'),
(3, 2, 'RESOLU',  'Déchets enlevés, zone nettoyée.');

INSERT INTO comments (report_id, author_id, body) VALUES
(1, 3, 'C''est vraiment urgent, merci d''intervenir.'),
(2, 2, 'Bonjour, nous avons pris en charge votre signalement.'),
(2, 4, 'Merci pour votre réactivité !');