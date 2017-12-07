# 3380Final

## Team Members
Shravan Dommaraju<br>
Andrew Muenks<br>
Patrick Rottman<br>
Jenny Zulovich<br>

## Description

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
