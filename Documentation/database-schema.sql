-- Users and Authentication
-- CREATE TYPE user_role AS ENUM (
--     'admin',
--     'insurance_agent',
--     'dispatcher',
--     'funeral_service',
--     'expeditor',
--     'hospital_staff',
--     'mosque_admin',
--     'mortuary_admin'
-- );

-- CREATE TYPE user_status AS ENUM (
--     'active',
--     'inactive',
--     'suspended',
--     'pending_verification'
-- );

-- CREATE TABLE users (
--     id BIGSERIAL PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     email VARCHAR(255) UNIQUE NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role user_role NOT NULL,
--     organization_id BIGINT REFERENCES organizations(id),
--     phone VARCHAR(20),
--     whatsapp_id VARCHAR(50),
--     profile_photo_path VARCHAR(2048),
--     status user_status DEFAULT 'pending_verification',
--     email_verified_at TIMESTAMP,
--     phone_verified_at TIMESTAMP,
--     settings JSONB DEFAULT '{}',
--     last_login_at TIMESTAMP,
--     remember_token VARCHAR(100),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Organizations (Insurance Companies, Funeral Services, etc.)
-- CREATE TYPE organization_type AS ENUM (
--     'insurance_company',
--     'funeral_service',
--     'hospital',
--     'mosque',
--     'mortuary',
--     'expeditor_company'
-- );

-- CREATE TABLE organizations (
--     id BIGSERIAL PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     type organization_type NOT NULL,
--     registration_number VARCHAR(100),
--     tax_number VARCHAR(100),
--     address_line1 VARCHAR(255),
--     address_line2 VARCHAR(255),
--     city VARCHAR(100),
--     state VARCHAR(100),
--     postal_code VARCHAR(20),
--     country VARCHAR(100),
--     phone VARCHAR(20),
--     email VARCHAR(255),
--     website VARCHAR(255),
--     operating_hours JSONB,
--     status VARCHAR(50) DEFAULT 'active',
--     verification_status VARCHAR(50) DEFAULT 'pending',
--     verified_at TIMESTAMP,
--     settings JSONB DEFAULT '{}',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Cases (Funeral Cases)
-- CREATE TYPE case_status AS ENUM (
--     'new',
--     'pending_verification',
--     'in_progress',
--     'pending_documents',
--     'pending_approval',
--     'approved',
--     'in_transit',
--     'completed',
--     'cancelled',
--     'on_hold'
-- );

-- CREATE TYPE death_type AS ENUM (
--     'natural',
--     'accident',
--     'hospital',
--     'other'
-- );

-- CREATE TYPE burial_type AS ENUM (
--     'local',
--     'repatriation'
-- );

-- CREATE TABLE cases (
--     id BIGSERIAL PRIMARY KEY,
--     reference_number VARCHAR(50) UNIQUE NOT NULL,
--     status case_status DEFAULT 'new',
--     death_type death_type NOT NULL,
--     burial_type burial_type NOT NULL,
--     deceased_details JSONB NOT NULL, -- name, age, nationality, etc.
--     death_details JSONB NOT NULL, -- date, time, location, cause
--     relative_details JSONB NOT NULL, -- contact person info
--     location_details JSONB NOT NULL, -- address and coordinates
--     insurance_details JSONB, -- policy number, coverage details
--     repatriation_details JSONB, -- flight details, destination
--     assigned_insurance_id BIGINT REFERENCES organizations(id),
--     assigned_dispatcher_id BIGINT REFERENCES users(id),
--     assigned_funeral_service_id BIGINT REFERENCES organizations(id),
--     assigned_expeditor_id BIGINT REFERENCES organizations(id),
--     assigned_hospital_id BIGINT REFERENCES organizations(id),
--     assigned_mosque_id BIGINT REFERENCES organizations(id),
--     assigned_mortuary_id BIGINT REFERENCES organizations(id),
--     created_by BIGINT REFERENCES users(id),
--     estimated_completion_date DATE,
--     completed_at TIMESTAMP,
--     cancelled_at TIMESTAMP,
--     cancellation_reason TEXT,
--     notes TEXT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Documents
-- CREATE TYPE document_type AS ENUM (
--     'death_certificate',
--     'medical_report',
--     'passport',
--     'id_card',
--     'insurance_policy',
--     'burial_permit',
--     'transit_permit',
--     'embassy_approval',
--     'police_report',
--     'morgue_release',
--     'flight_ticket',
--     'other'
-- );

-- CREATE TYPE document_status AS ENUM (
--     'pending',
--     'uploaded',
--     'verified',
--     'rejected',
--     'expired'
-- );

-- CREATE TABLE documents (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     type document_type NOT NULL,
--     file_path VARCHAR(2048) NOT NULL,
--     original_filename VARCHAR(255),
--     mime_type VARCHAR(100),
--     file_size INTEGER,
--     uploaded_by BIGINT REFERENCES users(id),
--     status document_status DEFAULT 'pending',
--     verification_notes TEXT,
--     verified_by BIGINT REFERENCES users(id),
--     verified_at TIMESTAMP,
--     expires_at TIMESTAMP,
--     metadata JSONB DEFAULT '{}',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Case Timeline / Activities
-- CREATE TYPE activity_type AS ENUM (
--     'case_created',
--     'status_changed',
--     'document_uploaded',
--     'document_verified',
--     'assignment_changed',
--     'note_added',
--     'message_sent',
--     'approval_requested',
--     'approval_granted',
--     'service_scheduled',
--     'service_completed',
--     'transport_arranged',
--     'relative_notification'
-- );

-- CREATE TABLE case_activities (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     activity_type activity_type NOT NULL,
--     user_id BIGINT REFERENCES users(id),
--     description TEXT NOT NULL,
--     metadata JSONB DEFAULT '{}',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Communications
-- CREATE TYPE message_type AS ENUM (
--     'chat',
--     'email',
--     'sms',
--     'whatsapp',
--     'system_notification'
-- );

-- CREATE TYPE message_status AS ENUM (
--     'sent',
--     'delivered',
--     'read',
--     'failed'
-- );

-- CREATE TABLE messages (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     sender_id BIGINT REFERENCES users(id),
--     receiver_id BIGINT REFERENCES users(id),
--     message_type message_type NOT NULL,
--     content TEXT NOT NULL,
--     metadata JSONB DEFAULT '{}',
--     status message_status DEFAULT 'sent',
--     read_at TIMESTAMP,
--     delivered_at TIMESTAMP,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Service Scheduling
-- CREATE TABLE service_schedules (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     service_type VARCHAR(50) NOT NULL, -- washing, prayer, burial, etc.
--     location_id BIGINT REFERENCES organizations(id),
--     scheduled_start TIMESTAMP NOT NULL,
--     scheduled_end TIMESTAMP NOT NULL,
--     status VARCHAR(50) DEFAULT 'scheduled',
--     notes TEXT,
--     created_by BIGINT REFERENCES users(id),
--     updated_by BIGINT REFERENCES users(id),
--     completed_at TIMESTAMP,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Transportation
-- CREATE TYPE transport_type AS ENUM (
--     'local',
--     'international',
--     'airport_transfer'
-- );

-- CREATE TABLE transport_arrangements (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     transport_type transport_type NOT NULL,
--     provider VARCHAR(255),
--     vehicle_details JSONB,
--     departure_location VARCHAR(255),
--     departure_time TIMESTAMP,
--     arrival_location VARCHAR(255),
--     estimated_arrival_time TIMESTAMP,
--     actual_arrival_time TIMESTAMP,
--     status VARCHAR(50) DEFAULT 'scheduled',
--     tracking_number VARCHAR(100),
--     cost_details JSONB,
--     notes TEXT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Approvals and Verifications
-- CREATE TABLE approvals (
--     id BIGSERIAL PRIMARY KEY,
--     case_id BIGINT REFERENCES cases(id),
--     approval_type VARCHAR(50) NOT NULL,
--     requested_by BIGINT REFERENCES users(id),
--     approved_by BIGINT REFERENCES users(id),
--     status VARCHAR(50) DEFAULT 'pending',
--     notes TEXT,
--     requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     approved_at TIMESTAMP,
--     rejected_at TIMESTAMP,
--     rejection_reason TEXT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Settings and Configurations
-- CREATE TABLE settings (
--     id BIGSERIAL PRIMARY KEY,
--     key VARCHAR(255) UNIQUE NOT NULL,
--     value TEXT,
--     description TEXT,
--     is_public BOOLEAN DEFAULT false,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Audit Logs
-- CREATE TABLE audit_logs (
--     id BIGSERIAL PRIMARY KEY,
--     user_id BIGINT REFERENCES users(id),
--     action VARCHAR(50) NOT NULL,
--     entity_type VARCHAR(50),
--     entity_id BIGINT,
--     old_values JSONB,
--     new_values JSONB,
--     ip_address VARCHAR(45),
--     user_agent TEXT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Indexes
CREATE INDEX idx_cases_reference_number ON cases(reference_number);
CREATE INDEX idx_cases_status ON cases(status);
CREATE INDEX idx_documents_case_id ON documents(case_id);
CREATE INDEX idx_case_activities_case_id ON case_activities(case_id);
CREATE INDEX idx_messages_case_id ON messages(case_id);
CREATE INDEX idx_messages_sender_receiver ON messages(sender_id, receiver_id);
CREATE INDEX idx_service_schedules_case_id ON service_schedules(case_id);
CREATE INDEX idx_transport_arrangements_case_id ON transport_arrangements(case_id);
CREATE INDEX idx_approvals_case_id ON approvals(case_id);
CREATE INDEX idx_audit_logs_user_id ON audit_logs(user_id);
CREATE INDEX idx_audit_logs_entity ON audit_logs(entity_type, entity_id);

-- Example Views
CREATE VIEW active_cases_summary AS
SELECT
    c.id,
    c.reference_number,
    c.status,
    c.death_type,
    c.burial_type,
    c.deceased_details->>'name' as deceased_name,
    c.created_at,
    COUNT(DISTINCT d.id) as document_count,
    COUNT(DISTINCT m.id) as message_count,
    COUNT(DISTINCT a.id) as pending_approvals
FROM cases c
LEFT JOIN documents d ON d.case_id = c.id
LEFT JOIN messages m ON m.case_id = c.id
LEFT JOIN approvals a ON a.case_id = c.id AND a.status = 'pending'
WHERE c.status NOT IN ('completed', 'cancelled')
GROUP BY c.id;

CREATE VIEW document_verification_queue AS
SELECT
    d.id as document_id,
    c.reference_number,
    d.type as document_type,
    d.created_at as uploaded_at,
    u.name as uploaded_by,
    d.status
FROM documents d
JOIN cases c ON c.id = d.case_id
JOIN users u ON u.id = d.uploaded_by
WHERE d.status = 'pending'
ORDER BY d.created_at ASC;
