**Software Requirements Specification (SRS) Document
**Online Support Ticket System
### 1. Introduction

#### 1.1 Purpose
The purpose of this document is to define the software requirements for the **Online Support Ticket System**. The system is intended to improve customer support management by automating ticket creation, tracking, and resolution.

#### 1.2 Document Conventions
- Use of **bold** for section headings.
- Bulleted lists for key features and functionalities.

#### 1.3 Intended Audience and Reading Suggestions
This document is intended for:
- Developers responsible for system implementation.
- Testers ensuring software quality.
- Project stakeholders, including businesses adopting the system.

#### 1.4 Product Scope
The **Online Support Ticket System** is a web-based application that enables businesses to manage customer support tickets efficiently. The system includes features for ticket submission, tracking, assignment, and escalation. It is intended for SMEs, IT support teams, e-commerce businesses, and educational institutions.

#### 1.5 References
- Project Proposal Document
- Web Design and Programming II Course Guidelines
### 2. Overall Description

#### 2.1 Product Perspective
The system is a standalone web application built using PHP, MySQL (backend), and React, HTML, CSS, JavaScript (frontend). It follows a role-based access control mechanism.

#### 2.2 Product Functions
- **User Registration & Authentication**: Secure login for customers, support agents, and administrators.
- **Ticket Management**: Customers can create tickets, track status, and receive notifications.
- **Support Agent Features**: Assign tickets, respond to customer queries, and update status.
- **Admin Dashboard**: Monitor system performance, manage users, and configure settings.
- **Automated Escalation**: High-priority tickets are escalated based on predefined rules.

#### 2.3 User Classes and Characteristics
- **Customers**: Users who submit support tickets.
- **Support Agents**: Handle ticket resolution.
- **Administrators**: Manage users and oversee the system.

#### 2.4 Operating Environment
- **Server-side**: Apache, PHP, MySQL (via XAMPP)
- **Client-side**: Any modern web browser
- **Development Tools**: Visual Studio Code, Postman, Selenium

#### 2.5 Design and Implementation Constraints
- The system should be responsive and accessible on both desktop and mobile.
- Role-based access control must be enforced.
- Security mechanisms should be implemented for authentication and data protection.

#### 2.6 Assumptions and Dependencies
- Internet access is required for email notifications.
- Users should have a basic understanding of web navigation.

---

### 3. Specific Requirements

#### 3.1 Functional Requirements
1. **User Authentication**:
   - Customers, agents, and admins must register and log in securely.
   - Password reset functionality should be available.
2. **Ticket Management**:
   - Customers can create, update, and track tickets.
   - Agents can assign, update, and resolve tickets.
3. **Notifications**:
   - Email and in-system notifications should be triggered for ticket updates.
4. **Admin Management**:
   - Admins can manage users, permissions, and system settings.
5. **Escalation Mechanism**:
   - Critical tickets are automatically flagged and escalated.

#### 3.2 Performance Requirements
- The system should handle up to 500 concurrent users.
- Response time for critical actions (login, ticket creation) should be <2 seconds.

#### 3.3 Security Requirements
- Encrypted password storage.
- Session timeout and secure authentication mechanisms.

#### 3.4 Software Quality Attributes
- **Usability**: Intuitive UI for seamless navigation.
- **Reliability**: The system should function with minimal downtime.
- **Maintainability**: The code should follow modular design principles.
### 4. Appendices
- Project timeline and milestones.
- Sample wireframes and ERD.
