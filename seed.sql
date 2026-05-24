-- password123 hashed with MD5
INSERT INTO users (name, email, password, address, contact, accountnum, meter_number, connection_type) VALUES
('Juan Dela Cruz', 'juan@email.com', '482c811da5d5b4bc6d497ffa98491e38', '123 Lucena City, Quezon', '+63 912 345 6789', 'PWM-123456789', 'WQ-2024-7890', 'Residential'),
('Maria Santos', 'maria@email.com', '482c811da5d5b4bc6d497ffa98491e38', '456 Quezon Ave, Lucena', '+63 923 456 7890', 'PWM-987654321', 'WQ-2024-7891', 'Residential'),
('Pedro Reyes', 'pedro@email.com', '482c811da5d5b4bc6d497ffa98491e38', '789 Manila St, Lucena', '+63 934 567 8901', 'PWM-456789123', 'WQ-2024-7892', 'Commercial');

INSERT INTO bills (user_id, accountnum, month, amount, duedate, status, previous_reading, present_reading, consumed, reading_date) VALUES
(1, 'PWM-123456789', 'January 2026', 1920.00, '2026-02-15', 'PAID', 1200, 1520, 320, '2026-01-01'),
(1, 'PWM-123456789', 'February 2026', 1710.00, '2026-03-15', 'PAID', 1520, 1805, 285, '2026-02-01'),
(1, 'PWM-123456789', 'March 2026', 1860.00, '2026-04-15', 'PAID', 1805, 2115, 310, '2026-03-01'),
(1, 'PWM-123456789', 'April 2026', 2100.00, '2026-05-15', 'PAID', 2115, 2465, 350, '2026-04-01'),
(1, 'PWM-123456789', 'May 2026', 2450.00, '2026-06-15', 'UNPAID', 2465, 2850, 385, '2026-05-01'),
(2, 'PWM-987654321', 'May 2026', 1800.50, '2026-06-15', 'UNPAID', 800, 1100, 300, '2026-05-01'),
(2, 'PWM-987654321', 'April 2026', 1650.00, '2026-05-15', 'PAID', 500, 800, 300, '2026-04-01');

INSERT INTO complaints (user_id, name, account_number, contact, address, complaint_type, complaint_text, status, ticket_number, date_filed) VALUES
(1, 'Juan Dela Cruz', 'PWM-123456789', '+63 912 345 6789', '123 Lucena City, Quezon', 'High Consumption', 'My bill for May seems unusually high compared to previous months.', 'Pending', 'CMP-2026-001', '2026-05-20'),
(1, 'Juan Dela Cruz', 'PWM-123456789', '+63 912 345 6789', '123 Lucena City, Quezon', 'Leaking Pipes', 'There is a leak in the pipe near my water meter.', 'Resolved', 'CMP-2026-002', '2026-05-15');

INSERT INTO service_requests (user_id, name, account_number, contact, address, request_type, description, status) VALUES
(1, 'Juan Dela Cruz', 'PWM-123456789', '+63 912 345 6789', '123 Lucena City, Quezon', 'Meter Reading', 'Please verify my meter reading for this month.', 'Resolved'),
(1, 'Juan Dela Cruz', 'PWM-123456789', '+63 912 345 6789', '123 Lucena City, Quezon', 'New Connection', 'I want to apply for a new water connection.', 'Pending');
