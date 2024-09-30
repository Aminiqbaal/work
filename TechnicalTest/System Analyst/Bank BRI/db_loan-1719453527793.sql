
CREATE TABLE Loan
(
  loanId    int       NOT NULL,
  userId    id        NOT NULL,
  amount    int       NOT NULL,
  tenure    int       NOT NULL,
  statusId  int       NOT NULL,
  createdAt timestamp NOT NULL,
  updateAt  timestamp NOT NULL,
  deleteAt  timestamp NOT NULL,
  PRIMARY KEY (loanId)
);

CREATE TABLE Notification
(
  notificationId int       NOT NULL,
  userId         id        NOT NULL,
  message        char      NOT NULL,
  createdAt      timestamp NOT NULL,
  updateAt       timestamp NOT NULL,
  deleteAt       timestamp NOT NULL,
  PRIMARY KEY (notificationId)
);

CREATE TABLE Role
(
  roleId      int       NOT NULL,
  description char      NOT NULL,
  createdAt   timestamp NOT NULL,
  updateAt    timestamp NOT NULL,
  deleteAt    timestamp NOT NULL,
  PRIMARY KEY (roleId)
);

CREATE TABLE Status
(
  statusId    int       NOT NULL,
  description char      NOT NULL,
  createdAt   timestamp NOT NULL,
  updateAt    timestamp NOT NULL,
  deleteAt    timestamp NOT NULL,
  PRIMARY KEY (statusId)
);

CREATE TABLE User
(
  userId      id        NOT NULL,
  roleId      int       NOT NULL,
  email       char      NOT NULL,
  phoneNumber int       NOT NULL,
  password    char      NOT NULL,
  photo       char      NOT NULL,
  ktp         char      NOT NULL,
  createdAt   timestamp NOT NULL,
  updateAt    timestamp NOT NULL,
  deleteAt    timestamp NOT NULL,
  PRIMARY KEY (userId)
);

ALTER TABLE Loan
  ADD CONSTRAINT FK_User_TO_Loan
    FOREIGN KEY (userId)
    REFERENCES User (userId);

ALTER TABLE Loan
  ADD CONSTRAINT FK_Status_TO_Loan
    FOREIGN KEY (statusId)
    REFERENCES Status (statusId);

ALTER TABLE Notification
  ADD CONSTRAINT FK_User_TO_Notification
    FOREIGN KEY (userId)
    REFERENCES User (userId);

ALTER TABLE User
  ADD CONSTRAINT FK_Role_TO_User
    FOREIGN KEY (roleId)
    REFERENCES Role (roleId);
