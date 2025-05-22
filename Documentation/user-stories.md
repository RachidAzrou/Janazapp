# JanazApp User Stories

## Authentication & User Management

### Administrator Stories
```agile
As an administrator,
I want to create new user accounts for organizations (insurance companies, funeral services, etc.),
So that they can access the system with appropriate permissions.

Acceptance Criteria:
1. Can create users with following required fields:
   - Full name
   - Email address
   - Phone number
   - Organization
   - Role (dropdown: insurance_agent, dispatcher, funeral_service, etc.)
2. System automatically sends email with temporary password
3. User must change password on first login
4. Can view list of all users with filters by:
   - Organization
   - Role
   - Status
5. Can disable/enable user accounts
6. Can reset user passwords
7. Each action is logged in audit_logs table
```

### User Authentication Stories
```agile
As a user,
I want to log into the system securely,
So that I can access my authorized features.

Acceptance Criteria:
1. Login form with:
   - Email field
   - Password field
   - "Remember me" checkbox
2. Validate credentials against database
3. Implement rate limiting (5 attempts per 5 minutes)
4. Show appropriate error messages
5. Redirect to role-specific dashboard after login
6. Store login timestamp in users table
7. Log failed login attempts

Technical Notes:
- Use Laravel Breeze for authentication
- Implement remember_token functionality
- Use Laravel's rate limiting middleware
```

## Insurance Agent Stories

### Case Creation
```agile
As an insurance agent,
I want to create a new case when receiving a death notification,
So that I can initiate the funeral process.

Acceptance Criteria:
1. Form with following sections:
   - Deceased Information:
     * Full name (required)
     * Date of birth (required)
     * Date of death (required)
     * Place of death (required)
     * Cause of death (required)
     * Nationality (required)
   - Next of Kin Information:
     * Full name (required)
     * Relationship to deceased (required)
     * Phone number (required)
     * WhatsApp number (optional)
     * Email (optional)
   - Case Type:
     * Local burial or repatriation (required)
     * If repatriation, destination country (required)
2. System generates unique reference number
3. Case status set to 'new'
4. WhatsApp notification sent to next of kin
5. Email notification sent to available dispatchers
6. Case appears in dispatcher dashboard

Technical Notes:
- Use Vue form validation
- Implement WhatsApp API integration
- Use Laravel notifications for emails
- Store case data in cases table
- Create activity log entry
```

### Case Management
```agile
As an insurance agent,
I want to view and manage all my assigned cases,
So that I can track their progress.

Acceptance Criteria:
1. Dashboard showing:
   - Total active cases
   - Cases by status
   - Cases requiring attention
2. Case list with:
   - Reference number
   - Deceased name
   - Status
   - Created date
   - Last update
3. Search functionality by:
   - Reference number
   - Deceased name
   - Next of kin name
4. Filter by:
   - Status
   - Date range
   - Case type
5. Sort by any column
6. Click case to view details

Technical Notes:
- Use Vue.js data tables
- Implement search using Laravel Scout
- Use Laravel API resources
- Implement proper pagination
```

## Dispatcher Stories

### Case Assignment
```agile
As a dispatcher,
I want to assign cases to funeral services,
So that they can begin their work.

Acceptance Criteria:
1. View list of new cases requiring assignment
2. For each case, show:
   - Reference number
   - Deceased details
   - Location
   - Case type
3. See available funeral services with:
   - Current workload
   - Distance from case location
   - Service rating
4. Assign case to funeral service with:
   - Optional notes
   - Priority level
5. System sends notification to funeral service
6. Case status updates to 'assigned'

Technical Notes:
- Use Leaflet.js for location visualization
- Implement distance calculation helper
- Use Laravel events for notifications
- Update case_activities table
```

## Funeral Service Stories

### Document Management
```agile
As a funeral service provider,
I want to upload and manage case documents,
So that all required paperwork is properly handled.

Acceptance Criteria:
1. Upload documents with:
   - Document type selection
   - File upload (PDF, JPG, PNG)
   - Optional notes
2. View document list showing:
   - Document type
   - Upload date
   - Status
   - Verification status
3. Preview uploaded documents
4. Replace/update documents
5. Receive notifications when:
   - Document needs attention
   - Document is verified/rejected
6. Track missing required documents

Technical Notes:
- Use Laravel Media Library
- Implement document preview using PDF.js
- Store documents in documents table
- Use Laravel storage for files
```

### Service Scheduling
```agile
As a funeral service provider,
I want to schedule washing and prayer services,
So that all religious requirements are met.

Acceptance Criteria:
1. Schedule creation with:
   - Service type (washing/prayer)
   - Date and time
   - Location selection
   - Duration
   - Required attendees
2. Calendar view of scheduled services
3. Conflict detection
4. Notification to all participants
5. Update/cancel scheduling
6. Mark services as completed

Technical Notes:
- Use Vue Calendar component
- Implement datetime validation
- Store in service_schedules table
- Use Laravel notifications
```

## Communication Stories

### WhatsApp Integration
```agile
As a system user,
I want to communicate with relatives via WhatsApp,
So that we can maintain clear communication.

Acceptance Criteria:
1. Start WhatsApp chat when case is created
2. Send automated updates for:
   - Case status changes
   - Document requirements
   - Schedule confirmations
3. Allow two-way communication
4. Store chat history
5. Support file sharing
6. Multiple agents can access chat history

Technical Notes:
- Integrate WhatsApp Business API
- Store messages in messages table
- Implement message queueing
- Handle message delivery status
```

### Internal Communication
```agile
As a system user,
I want to communicate with other stakeholders,
So that we can coordinate effectively.

Acceptance Criteria:
1. Chat interface between:
   - Insurance agents
   - Dispatchers
   - Funeral services
2. Support for:
   - Text messages
   - File sharing
   - Read receipts
3. Notification for new messages
4. Chat history retention
5. Search in chat history

Technical Notes:
- Use Laravel WebSockets
- Implement real-time updates
- Store in messages table
- Use Vue.js for chat interface
```

## Reporting Stories

### Case Reporting
```agile
As a manager,
I want to generate case reports,
So that I can monitor service performance.

Acceptance Criteria:
1. Generate reports for:
   - Cases by status
   - Average completion time
   - Document processing time
   - Service ratings
2. Filter by:
   - Date range
   - Organization
   - Case type
3. Export to:
   - PDF
   - Excel
4. Save report configurations
5. Schedule automated reports

Technical Notes:
- Use Laravel Excel
- Implement PDF generation
- Create report templates
- Use Laravel scheduled tasks
```

## System Integration Stories

### Location Services
```agile
As a system user,
I want to see and select locations on a map,
So that I can manage service locations effectively.

Acceptance Criteria:
1. Display interactive map
2. Show:
   - Funeral homes
   - Mosques
   - Hospitals
   - Mortuaries
3. Calculate distances
4. Get directions
5. Save favorite locations

Technical Notes:
- Use Leaflet.js
- Implement geocoding service
- Store locations in database
- Cache frequent locations
```
