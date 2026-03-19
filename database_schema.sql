-- =============================================
-- SMART NGO Database Schema
-- Generated from Laravel Migrations
-- =============================================

-- Create Database
CREATE DATABASE IF NOT EXISTS smart_ngo;
USE smart_ngo;

-- =============================================
-- 1. USERS TABLE
-- =============================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(255) UNIQUE NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) DEFAULT 'member' COMMENT 'admin, staff, member, volunteer',
    status VARCHAR(255) DEFAULT 'active' COMMENT 'active, blocked',
    referral_code VARCHAR(255) UNIQUE NULL,
    referred_by_id BIGINT UNSIGNED NULL,
    designation_id BIGINT UNSIGNED NULL,
    dob DATE NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX users_referred_by_id_foreign (referred_by_id),
    CONSTRAINT users_referred_by_id_foreign FOREIGN KEY (referred_by_id) REFERENCES users (id) ON DELETE SET NULL
);

-- =============================================
-- 2. PASSWORD_RESET_TOKENS TABLE
-- =============================================
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- =============================================
-- 3. SESSIONS TABLE
-- =============================================
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id)
);

-- =============================================
-- 4. DESIGNATIONS TABLE
-- =============================================
CREATE TABLE designations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 5. CAMPAIGNS TABLE
-- =============================================
CREATE TABLE campaigns (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NOT NULL,
    goal_amount DECIMAL(15,2) NOT NULL,
    current_amount DECIMAL(15,2) DEFAULT 0.00,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    image VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 6. DONATIONS TABLE
-- =============================================
CREATE TABLE donations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    campaign_id BIGINT UNSIGNED NULL,
    donor_name VARCHAR(255) NOT NULL,
    donor_email VARCHAR(255) NOT NULL,
    donor_phone VARCHAR(255) NULL,
    amount DECIMAL(15,2) NOT NULL,
    payment_method VARCHAR(255) NOT NULL COMMENT 'online, cash, custom',
    payment_gateway VARCHAR(255) NULL COMMENT 'razorpay, phonepe, payu',
    transaction_id VARCHAR(255) NULL,
    receipt_number VARCHAR(255) UNIQUE NOT NULL,
    is_80g BOOLEAN DEFAULT FALSE,
    status VARCHAR(255) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX donations_user_id_foreign (user_id),
    INDEX donations_campaign_id_foreign (campaign_id),
    CONSTRAINT donations_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL,
    CONSTRAINT donations_campaign_id_foreign FOREIGN KEY (campaign_id) REFERENCES campaigns (id) ON DELETE SET NULL
);

-- =============================================
-- 7. ACTIVITIES TABLE
-- =============================================
CREATE TABLE activities (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    caption TEXT NOT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX activities_user_id_foreign (user_id),
    CONSTRAINT activities_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- =============================================
-- 8. EVENTS TABLE
-- =============================================
CREATE TABLE events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NOT NULL,
    event_date DATETIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    fees DECIMAL(10,2) DEFAULT 0.00,
    max_participants INT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 9. NEWS TABLE
-- =============================================
CREATE TABLE news (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 10. ENQUIRIES TABLE
-- =============================================
CREATE TABLE enquiries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    status VARCHAR(255) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX enquiries_user_id_foreign (user_id),
    CONSTRAINT enquiries_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL
);

-- =============================================
-- 11. EXPENSES TABLE
-- =============================================
CREATE TABLE expenses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    amount DECIMAL(15,2) NOT NULL,
    category VARCHAR(255) NOT NULL,
    bill_image VARCHAR(255) NULL,
    expense_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 12. PROJECTS TABLE
-- =============================================
CREATE TABLE projects (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    budget DECIMAL(15,2) DEFAULT 0.00,
    spent DECIMAL(15,2) DEFAULT 0.00,
    status VARCHAR(255) DEFAULT 'ongoing',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 13. BENEFICIARIES TABLE
-- =============================================
CREATE TABLE beneficiaries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    address TEXT NULL,
    category VARCHAR(255) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 14. CERTIFICATES TABLE
-- =============================================
CREATE TABLE certificates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    beneficiary_id BIGINT UNSIGNED NOT NULL,
    certificate_type VARCHAR(255) NOT NULL,
    certificate_number VARCHAR(255) UNIQUE NOT NULL,
    issue_date DATE NOT NULL,
    expiry_date DATE NULL,
    description TEXT NULL,
    file_path VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX certificates_beneficiary_id_foreign (beneficiary_id),
    CONSTRAINT certificates_beneficiary_id_foreign FOREIGN KEY (beneficiary_id) REFERENCES beneficiaries (id) ON DELETE CASCADE
);

-- =============================================
-- 15. INTERNSHIPS TABLE
-- =============================================
CREATE TABLE internships (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT NULL,
    duration VARCHAR(255) NOT NULL,
    stipend DECIMAL(10,2) NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    location VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 16. SETTINGS TABLE
-- =============================================
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- 17. CACHE TABLE
-- =============================================
CREATE TABLE cache (
    key VARCHAR(255) PRIMARY KEY,
    value LONGTEXT NOT NULL,
    expiration INT NOT NULL
);

-- =============================================
-- 18. JOBS TABLE
-- =============================================
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL,
    reserved_at INT UNSIGNED NULL,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL
);

-- =============================================
-- INSERT SAMPLE DATA
-- =============================================

-- Insert Designations
INSERT INTO designations (name) VALUES 
('President'),
('Secretary'),
('Treasurer'),
('Director'),
('Manager'),
('Coordinator'),
('Volunteer'),
('Member');

-- Insert Admin User
INSERT INTO users (name, email, password, role, status, phone, dob) VALUES 
('Admin User', 'admin@smartngo.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', '9876543210', '1990-01-01');

-- Insert Sample Campaigns
INSERT INTO campaigns (title, slug, description, goal_amount, current_amount, start_date, end_date, is_active) VALUES 
('Education for All', 'education-for-all', 'Providing quality education to underprivileged children in rural areas.', 100000.00, 25000.00, '2024-01-01', '2024-12-31', TRUE),
('Clean Water Initiative', 'clean-water-initiative', 'Installing water purification systems in villages lacking clean drinking water.', 75000.00, 15000.00, '2024-03-01', '2024-11-30', TRUE),
('Healthcare Camp', 'healthcare-camp', 'Free medical check-up camps for remote communities.', 50000.00, 8000.00, '2024-06-01', '2024-08-31', TRUE);

-- Insert Sample Projects
INSERT INTO projects (title, description, budget, spent, status) VALUES 
('School Construction', 'Building a new school in the remote village.', 200000.00, 45000.00, 'ongoing'),
('Solar Power Installation', 'Installing solar panels for community centers.', 80000.00, 20000.00, 'ongoing'),
('Medical Equipment', 'Providing medical equipment to local clinics.', 60000.00, 35000.00, 'completed');

-- Insert Sample Events
INSERT INTO events (title, slug, description, event_date, location, fees, max_participants) VALUES 
('Annual Fundraiser', 'annual-fundraiser', 'Join us for our annual fundraising gala to support our ongoing projects.', '2024-04-15 19:00:00', 'Community Center, Main Street', 50.00, 200),
('Volunteer Meetup', 'volunteer-meetup', 'Monthly meeting for all volunteers to discuss upcoming activities.', '2024-03-25 10:00:00', 'NGO Office', 0.00, 50),
('Health Awareness Camp', 'health-awareness-camp', 'Free health check-up and awareness camp for all ages.', '2024-05-20 09:00:00', 'City Hospital Ground', 0.00, 500);

-- Insert Sample News
INSERT INTO news (title, slug, content) VALUES 
('NGO Wins National Award', 'ngo-wins-national-award', 'Our organization has been recognized for outstanding community service and impact in education sector.'),
('New Partnership Announced', 'new-partnership-announced', 'We are excited to announce our partnership with TechCorp to enhance digital literacy programs.'),
('Success Story: 1000 Children Educated', 'success-story-1000-children-educated', 'We have successfully reached our milestone of educating 1000 underprivileged children this year.');

-- Insert Sample Beneficiaries
INSERT INTO beneficiaries (name, email, phone, address, category, description) VALUES 
('Ramesh Kumar', 'ramesh@email.com', '9876543210', 'Village Road, Block A', 'Education', 'Student needing financial support for higher education'),
('Sita Devi', 'sita@email.com', '9876543211', 'Main Street, House 123', 'Healthcare', 'Elderly person requiring medical assistance'),
('Amit Singh', 'amit@email.com', '9876543212', 'Colony Area, Flat 4B', 'Livelihood', 'Unskilled worker seeking vocational training');

-- Insert Sample Settings
INSERT INTO settings (key, value) VALUES 
('site_name', 'Smart NGO'),
('site_email', 'info@smartngo.org'),
('site_phone', '+91-9876543210'),
('site_address', '123 NGO Street, City - 123456'),
('donation_receipt_prefix', 'DON-'),
('tax_exemption_number', '80G-123456789'),
('social_facebook', 'https://facebook.com/smartngo'),
('social_twitter', 'https://twitter.com/smartngo'),
('social_instagram', 'https://instagram.com/smartngo');

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================

CREATE INDEX campaigns_is_active_index ON campaigns(is_active);
CREATE INDEX campaigns_start_date_index ON campaigns(start_date);
CREATE INDEX donations_status_index ON donations(status);
CREATE INDEX donations_payment_method_index ON donations(payment_method);
CREATE INDEX donations_amount_index ON donations(amount);
CREATE INDEX donations_created_at_index ON donations(created_at);
CREATE INDEX events_event_date_index ON events(event_date);
CREATE INDEX events_fees_index ON events(fees);
CREATE INDEX expenses_expense_date_index ON expenses(expense_date);
CREATE INDEX expenses_category_index ON expenses(category);
CREATE INDEX beneficiaries_category_index ON beneficiaries(category);
CREATE INDEX internships_is_active_index ON internships(is_active);
CREATE INDEX users_role_index ON users(role);
CREATE INDEX users_status_index ON users(status);
CREATE INDEX users_email_index ON users(email);

-- =============================================
-- VIEWS FOR COMMON QUERIES
-- =============================================

CREATE VIEW campaign_summary AS
SELECT 
    c.id,
    c.title,
    c.goal_amount,
    c.current_amount,
    ROUND((c.current_amount / c.goal_amount) * 100, 2) as progress_percentage,
    c.start_date,
    c.end_date,
    c.is_active,
    (SELECT COUNT(*) FROM donations d WHERE d.campaign_id = c.id AND d.status = 'completed') as donation_count,
    (SELECT SUM(d.amount) FROM donations d WHERE d.campaign_id = c.id AND d.status = 'completed') as total_donations
FROM campaigns c;

CREATE VIEW donation_summary AS
SELECT 
    d.id,
    d.donor_name,
    d.donor_email,
    d.amount,
    d.payment_method,
    d.status,
    d.receipt_number,
    d.created_at,
    c.title as campaign_title,
    u.name as user_name
FROM donations d
LEFT JOIN campaigns c ON d.campaign_id = c.id
LEFT JOIN users u ON d.user_id = u.id;

CREATE VIEW project_financial_summary AS
SELECT 
    p.id,
    p.title,
    p.budget,
    p.spent,
    (p.budget - p.spent) as remaining,
    ROUND((p.spent / p.budget) * 100, 2) as spending_percentage,
    p.status
FROM projects p;

-- =============================================
-- STORED PROCEDURES
-- =============================================

DELIMITER //

-- Procedure to update campaign amount when donation is completed
CREATE PROCEDURE update_campaign_amount(IN donation_id BIGINT)
BEGIN
    DECLARE campaign_id_val BIGINT;
    DECLARE donation_amount DECIMAL(15,2);
    
    SELECT campaign_id, amount INTO campaign_id_val, donation_amount
    FROM donations WHERE id = donation_id AND status = 'completed';
    
    IF campaign_id_val IS NOT NULL THEN
        UPDATE campaigns 
        SET current_amount = current_amount + donation_amount
        WHERE id = campaign_id_val;
    END IF;
END //

-- Procedure to generate receipt number
CREATE PROCEDURE generate_receipt_number(OUT receipt_num VARCHAR(255))
BEGIN
    DECLARE next_id INT;
    
    SELECT COALESCE(MAX(CAST(SUBSTRING(receipt_number, 5) AS UNSIGNED)), 0) + 1 INTO next_id
    FROM donations;
    
    SET receipt_num = CONCAT('DON-', LPAD(next_id, 6, '0'));
END //

DELIMITER ;

-- =============================================
-- TRIGGERS
-- =============================================

-- Trigger to auto-generate receipt number for new donations
DELIMITER //
CREATE TRIGGER before_donation_insert
BEFORE INSERT ON donations
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    
    IF NEW.receipt_number IS NULL OR NEW.receipt_number = '' THEN
        SELECT COALESCE(MAX(CAST(SUBSTRING(receipt_number, 5) AS UNSIGNED)), 0) + 1 INTO next_id
        FROM donations;
        
        SET NEW.receipt_number = CONCAT('DON-', LPAD(next_id, 6, '0'));
    END IF;
END //
DELIMITER ;

-- =============================================
-- DATABASE COMPLETION
-- =============================================

-- Show table creation summary
SELECT 
    TABLE_NAME as 'Table Name',
    TABLE_ROWS as 'Rows',
    ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024), 2) as 'Size (MB)'
FROM information_schema.TABLES 
WHERE TABLE_SCHEMA = 'smart_ngo'
ORDER BY TABLE_NAME;
