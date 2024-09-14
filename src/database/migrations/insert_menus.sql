-- insert role

INSERT INTO roles (name, created_at, updated_at)
VALUES
    ('admin' , NOW(), NOW()),
    ('sale' , NOW(), NOW()),
    ('accounting' , NOW(), NOW()),
    ('manager', NOW(), NOW());


-- insert manu

INSERT INTO menus (title, icon, route, created_at, updated_at)
VALUES
    ('DRAFTS', 'package', NULL, NOW(), NOW()),
    ('JOB', 'folder', NULL, NOW(), NOW()),
    ('INVOICE', 'archive', NULL, NOW(), NOW()),
    ('ใบเสร็จ มี VAT', 'bar-chart', NULL, NOW(), NOW()),
    ('ใบเสร็จ ไม่มี VAT', 'shopping-cart', NULL, NOW(), NOW()),
    ('Account Report', 'file-text', NULL, NOW(), NOW()),
    ('Manager Report', 'file-text', NULL, NOW(), NOW()),
    ('รายงานต้นทุนเเละภาษีสั่งซื้อ', 'file-text', NULL, NOW(), NOW()),
    ('รายงานลูกหนี้', 'file-text', NULL, NOW(), NOW()),
    ('รายงาน KBA,KBC', 'file-text', NULL, NOW(), NOW()),
    ('รายงานการขาย', 'file-text', NULL, NOW(), NOW()),
    ('จัดการผู้ใช้งาน', 'user', NULL, NOW(), NOW()),
    ('การตั้งค่า', 'settings', NULL, NOW(), NOW());


 INSERT INTO roles_menus (menu_id, role_id)
SELECT menus.id AS menu_id, roles.id AS role_id
FROM menus
CROSS JOIN roles
WHERE menus.title IN ('จัดการผู้ใช้งาน')
AND roles.name = 'admin';

INSERT INTO roles_menus (menu_id, role_id)
SELECT menus.id AS menu_id, roles.id AS role_id
FROM menus
CROSS JOIN roles
WHERE menus.title IN ('DRAFTS', 'JOB', 'การตั้งค่า')
AND roles.name = 'sale';

INSERT INTO roles_menus (menu_id, role_id)
SELECT menus.id AS menu_id, roles.id AS role_id
FROM menus
CROSS JOIN roles
WHERE menus.title IN ('INVOICE', 'ใบเสร็จ มี VAT', 'ใบเสร็จ ไม่มี VAT', 'Account Report', 'การตั้งค่า')
AND roles.name = 'accounting';

INSERT INTO roles_menus (menu_id, role_id)
SELECT menus.id AS menu_id, roles.id AS role_id
FROM menus
CROSS JOIN roles
WHERE menus.title IN ('Manager Report', 'รายงานต้นทุนเเละภาษีสั่งซื้อ', 'รายงานลูกหนี้', 'รายงาน KBA,KBC', 'รายงานการขาย', 'การตั้งค่า')
AND roles.name = 'manager';   


INSERT INTO sub_menus (menu_id, title, icon, route, created_at, updated_at)
VALUES
    -- DRAFTS submenu
    ((SELECT id FROM menus WHERE title = 'DRAFTS'), 'รายการDrafts', 'file-text', 'drafts.index', NOW(), NOW()),
    
    -- JOB submenu
    ((SELECT id FROM menus WHERE title = 'JOB'), 'รายการJOB', 'file-text', 'job.index', NOW(), NOW()),
    
    -- INVOICE submenu
    ((SELECT id FROM menus WHERE title = 'INVOICE'), 'รายการINVOICE', 'file-text', 'invoice.index', NOW(), NOW()),
    
    -- ใบเสร็จ มี VAT submenu
    ((SELECT id FROM menus WHERE title = 'ใบเสร็จ มี VAT'), 'รายการใบเสร็จ มี VAT', 'file-text', 'receipt.vat.index', NOW(), NOW()),
    
    -- ใบเสร็จ ไม่มี VAT submenu
    ((SELECT id FROM menus WHERE title = 'ใบเสร็จ ไม่มี VAT'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- Account Report submenu
    ((SELECT id FROM menus WHERE title = 'Account Report'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- Manager Report submenu
    ((SELECT id FROM menus WHERE title = 'Manager Report'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- รายงานต้นทุนเเละภาษีสั่งซื้อ submenu
    ((SELECT id FROM menus WHERE title = 'รายงานต้นทุนเเละภาษีสั่งซื้อ'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- รายงานลูกหนี้ submenu
    ((SELECT id FROM menus WHERE title = 'รายงานลูกหนี้'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- รายงาน KBA,KBC submenu
    ((SELECT id FROM menus WHERE title = 'รายงาน KBA,KBC'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- รายงานการขาย submenu
    ((SELECT id FROM menus WHERE title = 'รายงานการขาย'), '?', 'file-text', '#', NOW(), NOW()), -- Replace '?' and '#' with appropriate values
    
    -- จัดการผู้ใช้งาน submenu
    ((SELECT id FROM menus WHERE title = 'จัดการผู้ใช้งาน'), 'จัดการสิทธิ์การเข้าถึง', 'users', 'users.permission.index', NOW(), NOW()), -- Replace '?' with appropriate values

    -- จัดการผู้ใช้งาน submenu
    ((SELECT id FROM menus WHERE title = 'จัดการผู้ใช้งาน'), 'รายชื่อผู้ใช้งาน', 'users', 'users.permission.index', NOW(), NOW()), -- Replace '?' with appropriate values
    
    -- การตั้งค่า submenu
    ((SELECT id FROM menus WHERE title = 'การตั้งค่า'), '?', 'settings', '#', NOW(), NOW()); -- Replace '?' and '#' with appropriate values






