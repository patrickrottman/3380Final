# 3380Final

## Team Members
Shravan Dommaraju<br>
Andrew Muenks<br>
Patrick Rottman<br>
Jenny Zulovich<br>

## Purpose

Create a platform where all members of a foster child’s permanency team would be able to share documents/notes. Within the system, there would be many roles, namely case managers, case workers, therapists, psychiatrists, doctors, foster parents, and biological parents.  Then, each member of that group would be able to upload documents with their notes (incident reports, memos, doctor’s notes) and the other members of the permanency team would also be able to see those documents. Currently, there is a problem with communication among permanency teams, so creating a separate platform to upload pertinent documents for a child would be useful, where a user would simply upload a document for a child, and all the other people who might need access would get it to show up automatically. 

## Table Schemas

### Children
|Field                |Type          |Null   |Key    |Default    |Extra          |
|---------------------|--------------|-------|-------|-----------|---------------|
|id                   |int(11)       |NO     |PRI    |*NULL*     |auto_increment |
|firstName            |varchar(128)  |NO     |       |*NULL*     |               |
|middleName           |varchar(128)  |YES    |       |*NULL*     |               |
|lastName             |varchar(128)  |NO     |       |*NULL*     |               |
|dateOfBirth          |varchar(128)  |YES    |       |*NULL*     |               |
|caseManagerID        |int(11)       |NO     |       |*NULL*     |               |
|caseWorkerID         |int(11)       |YES    |       |*NULL*     |               |
|therapistID          |int(11)       |YES    |       |*NULL*     |               |
|psychiatristID       |int(11)       |YES    |       |*NULL*     |               |
|doctorID             |int(11)       |YES    |       |*NULL*     |               |
|fosterParent1ID      |int(11)       |YES    |       |*NULL*     |               |
|fosterParent2ID      |int(11)       |YES    |       |*NULL*     |               |
|biologicalParent1ID  |int(11)       |YES    |       |*NULL*     |               |
|biologicalParent2ID  |int(11)       |YES    |       |*NULL*     |               |

### Documents
|Field          |Type          |Null   |Key    |Default    |Extra          |
|---------------|--------------|-------|-------|-----------|---------------|
|id             |int(11)       |NO     |PRI    |*NULL*     |auto_increment |
|childID        |int(11)       |NO     |       |*NULL*     |               |
|uploaderID     |int(11)       |NO     |       |*NULL*     |               |
|documentText   |mediumtext    |NO     |       |*NULL*     |               |
|uploadTime     |datetime      |NO     |       |*NULL*     |               |

### Workers
|Field       |Type          |Null   |Key    |Default    |Extra          |
|------------|--------------|-------|-------|-----------|---------------|
|id          |int(11)       |NO     |PRI    |*NULL*     |auto_increment |
|role        |enum('case manager','case worker','therapist','psychiatrist','doctor', 'foster parent', 'biological parent'              |NO     |       |*NULL*     |               |
|username    |varchar(255)  |NO     |UNI    |*NULL*     |               |
|password    |varchar(255)  |NO     |       |*NULL*     |               |
|firstName   |varchar(128)  |NO     |       |*NULL*     |               |
|middleName  |varchar(128)  |YES    |       |*NULL*     |               |
|lastName    |varchar(128)  |NO     |       |*NULL*     |               |

## Entity Relationship Diagram
![alt text](https://github.com/patrickrottman/3380Final/blob/master/FinalProjectERD.png "ERD")

## CRUD Explanations
#### Create
In the application, the user can add a child if they are a case manager and every user can add a document for a child.

#### Read
Once logged in, the application will display children for a user. They can click on a child and display the documents for the child. The displayed data is read from the data base.

#### Update
Users can edit documents that they wrote and update them to the database.

#### Delete
Users can delete documents from the database if they are the ones who wrote them.


## Video Demonstration
