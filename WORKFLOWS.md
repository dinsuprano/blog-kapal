# System Workflow Diagrams

## Overall Architecture

```mermaid
graph TB
    A[User Browser] --> B[Laravel Application]
    B --> C[Filament Admin Panel]
    B --> D[Blog Frontend]
    B --> E[Database]
    
    C --> F[Content Management]
    C --> G[User Management]
    C --> H[Media Management]
    
    D --> I[Blog Posts]
    D --> J[Categories]
    D --> K[Comments]
    
    E --> L[Users Table]
    E --> M[Blog Posts Table]
    E --> N[Categories Table]
    E --> O[Comments Table]
```

## Content Creation Workflow

```mermaid
sequenceDiagram
    participant Admin
    participant FilamentPanel
    participant Database
    participant Frontend
    
    Admin->>FilamentPanel: Login to admin panel
    Admin->>FilamentPanel: Navigate to Blog Posts
    Admin->>FilamentPanel: Create new post
    FilamentPanel->>Admin: Show post creation form
    Admin->>FilamentPanel: Fill post details (title, content, etc.)
    Admin->>FilamentPanel: Upload featured image
    Admin->>FilamentPanel: Set categories and tags
    Admin->>FilamentPanel: Configure SEO settings
    Admin->>FilamentPanel: Save as draft or publish
    FilamentPanel->>Database: Store post data
    Database->>Frontend: Post becomes available
    Frontend->>Users: Display published post
```

## User Interaction Flow

```mermaid
stateDiagram-v2
    [*] --> BlogHomepage: Visit /blog
    BlogHomepage --> PostListing: Browse posts
    BlogHomepage --> CategoryView: Select category
    BlogHomepage --> SearchResults: Use search
    
    PostListing --> PostDetail: Click on post
    CategoryView --> PostDetail: Click on post
    SearchResults --> PostDetail: Click on post
    
    PostDetail --> Comments: Read comments
    PostDetail --> AuthorProfile: View author
    PostDetail --> RelatedPosts: Browse related
    
    Comments --> WriteComment: [Authenticated] Leave comment
    WriteComment --> Comments: Comment submitted
    
    PostDetail --> [*]: Navigate away
    Comments --> [*]: Navigate away
    AuthorProfile --> [*]: Navigate away
```

## Database Relationships

```mermaid
erDiagram
    USERS ||--o{ POSTS : creates
    USERS ||--o{ COMMENTS : writes
    POSTS ||--o{ COMMENTS : has
    POSTS }o--|| CATEGORIES : belongs_to
    POSTS }o--o{ TAGS : has_many
    
    USERS {
        int id PK
        string name
        string email
        string profile_photo_path
        text description
        string url_link
    }
    
    POSTS {
        int id PK
        string title
        string slug
        text content
        text excerpt
        int user_id FK
        int category_id FK
        datetime published_at
        boolean featured
        string status
    }
    
    CATEGORIES {
        int id PK
        string name
        string slug
        text description
        boolean is_visible
    }
    
    TAGS {
        int id PK
        string name
        string slug
    }
    
    COMMENTS {
        int id PK
        text content
        int user_id FK
        int post_id FK
        boolean is_visible
        datetime approved_at
    }
```

## Admin Panel Structure

```mermaid
graph LR
    A[Admin Dashboard] --> B[Blog Management]
    A --> C[User Management]
    A --> D[Media Library]
    A --> E[Settings]
    
    B --> F[Posts]
    B --> G[Categories]
    B --> H[Tags]
    B --> I[Comments]
    
    F --> J[Create Post]
    F --> K[Edit Post]
    F --> L[Delete Post]
    F --> M[Bulk Actions]
    
    C --> N[User List]
    C --> O[User Profiles]
    C --> P[User Permissions]
    
    D --> Q[Image Upload]
    D --> R[File Management]
    D --> S[Media Organization]
```

## Comment Moderation Flow

```mermaid
flowchart TD
    A[User submits comment] --> B{User authenticated?}
    B -->|No| C[Reject comment]
    B -->|Yes| D[Store comment in database]
    D --> E{Auto-approval enabled?}
    E -->|Yes| F[Comment visible immediately]
    E -->|No| G[Comment pending approval]
    G --> H[Admin reviews comment]
    H --> I{Approve comment?}
    I -->|Yes| J[Comment becomes visible]
    I -->|No| K[Comment remains hidden/deleted]
    F --> L[Send notification to post author]
    J --> L
```

## SEO and Frontend Rendering

```mermaid
graph TB
    A[User requests blog page] --> B[Laravel Router]
    B --> C[Firefly Blog Controller]
    C --> D[Query Database]
    D --> E[Load Post Data]
    E --> F[Generate SEO Meta Tags]
    F --> G[Render Blade Template]
    G --> H[Apply TailwindCSS Styling]
    H --> I[Add Livewire Components]
    I --> J[Send HTML Response]
    J --> K[User sees rendered page]
```

These diagrams provide a visual representation of how the blog system works at different levels, from high-level architecture to specific workflows and data relationships.