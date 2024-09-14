CREATE TABLE jobs (
    job_no INT PRIMARY KEY AUTO_INCREMENT,
    draft_no INT,
    cost_remark TEXT,
    sell_remark TEXT,
    job_date TIMESTAMP DEFAULT NULL,
    prepared_by INT UNSIGNED, -- Assuming 'id' in 'users' is of type INT UNSIGNED
    edit_by INT UNSIGNED NULL, -- Assuming 'id' in 'users' is of type INT UNSIGNED
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edit_date TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (draft_no) REFERENCES drafts(draft_no),
    FOREIGN KEY (prepared_by) REFERENCES users(id),
    FOREIGN KEY (edit_by) REFERENCES users(id)
);



CREATE TABLE costs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    rate_value INT,
    vat_value INT,
    description TEXT,
    value FLOAT,
    rate BOOLEAN,
    vat BOOLEAN,
    tax FLOAT,
    job_no INT,
    FOREIGN KEY (job_no) REFERENCES jobs(job_no)
);

