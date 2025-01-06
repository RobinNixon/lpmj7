START TRANSACTION;
UPDATE accounts SET balance=balance+25 WHERE number=12345;
COMMIT;
SELECT * FROM accounts;
