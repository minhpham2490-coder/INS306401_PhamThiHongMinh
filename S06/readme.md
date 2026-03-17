PART 1: NORMALIZATION CHALLENGE
| Table Name | Primary Key (PK) | Foreign Key (FK) | Normal Form | Description |
| :--- | :--- | :--- | :--- | :--- |
| 'students' | 'student_id' | None | 3NF | Stores student profile information. |
| 'professors' | 'professor_name' | None | 3NF | Stores faculty contact details. |
| 'courses' | 'course_id' | 'professor_name' | 3NF | Maps courses to specific professors. |
| 'grades' | 'student_id', 'course_id' | 'student_id', 'course_id' | 3NF | Records academic performance. |

PART 2: RELATIONSHIP DRILLS

- **Author to Book:** One-to-Many (1:N). An author can write multiple books. (FK: 'author_id' in 'Book' table).
- **Citizen to Passport:** One-to-One (1:1). Each citizen has exactly one unique passport. (FK: 'citizen_id' in 'Passport' table + 'UNIQUE').
- **Customer to Order:** One-to-Many (1:N). A customer can place multiple orders. (FK: 'customer_id' in 'Order' table).
- **Student to Class:** Many-to-Many (N:N). Students take multiple classes, and classes have many students. (Requires **Junction Table**: 'Enrollments').
- **Team to Player:** One-to-Many (1:N). A team consists of multiple players. (FK: 'team_id' in 'Player' table).