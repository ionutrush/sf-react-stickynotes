# Sticky Notes API

## Key Features
### Note Management
- Create, read, update, and delete notes
- Organize notes with tags and categories

### Security Measures
- JWT token rotation
- HTTPS-only communication
- Rate limiting to prevent abuse

## Performance Optimizations
- Database query optimization with proper indexing
- Response caching for frequently accessed data
- Lazy loading of related entities

---

We set out to solve several common challenges in modern note-taking applications:
1. **Secure Authentication**: Ensuring user data remains private while providing a seamless login experience
2. **Data Persistence**: Providing reliable storage with protection against data loss
3. **Real-Time Collaboration**: Supporting multiple users working with shared notes
4. **Performance at Scale**: Handling large volumes of notes and concurrent users efficiently

## Our Approach
### Authentication System
We implemented JWT (JSON Web Token) authentication using the LexikJWTAuthenticationBundle for several key reasons:
- **Stateless Architecture**: No need to store session data on the server, improving scalability
- **Cross-Domain Support**: Enables seamless front-end and mobile integration
- **Performance**: Minimizes database lookups for authentication checks
- **Security**: Tokens can be configured with short expiration times and refresh token rotation

### Data Storage
We chose Doctrine ORM with a relational database because:
- **Data Integrity**: Ensures relationships between users, notes, and shared permissions remain consistent
- **Query Efficiency**: Optimized for the types of queries our application needs most (filtering, sorting, searching)
- **Transaction Support**: Critical for operations that modify multiple related records

### API Architecture
Our RESTful API design follows these principles:
- **Proper HTTP Methods**: Using GET, POST, PUT, DELETE appropriately
- **Comprehensive Status Codes**: Providing clear feedback on request outcomes