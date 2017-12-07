# 3380Final

## Team Members
Shravan Dommaraju
Andrew Muenks
Patrick Rottman
Jenny Zulovich

## Description

## Table Schemas

### Children
|Field                |Type          |Null   |Key    |Default    |Extra          |
|---------------------|--------------|-------|-------|-----------|---------------|
|id                   |int(11)       |NO     |PRI    |*NULL*     |auto_increment |
|firstName            |varchar(128)  |NO     |       |*NULL*     |               |
|middleName           |varchar(128)  |YES    |       |*NULL*     |               |
|lastName             |varchar(128)  |NO     |       |*NULL*     |               |
|dateOfBirth          |date          |YES    |       |*NULL*     |               |
|caseManagerID        |int(11)       |NO     |       |*NULL*     |               |
|caseWorkerID         |int(11)       |YES    |       |*NULL*     |               |
|therapistID          |int(11)       |YES    |       |*NULL*     |               |
|psychiatristID       |int(11)       |YES    |       |*NULL*     |               |
|doctorID             |int(11)       |YES    |       |*NULL*     |               |
|fosterParent1ID      |int(11)       |YES    |       |*NULL*     |               |
|fosterParent2ID      |int(11)       |YES    |       |*NULL*     |               |
|biologicalParent1ID  |int(11)       |YES    |       |*NULL*     |               |
|biologicalParent2ID  |int(11)       |YES    |       |*NULL*     |               |
