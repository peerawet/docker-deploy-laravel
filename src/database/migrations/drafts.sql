CREATE TABLE drafts (
    draft_no INT AUTO_INCREMENT PRIMARY KEY,
    booking_no VARCHAR(255) NULL,
    customer_ref VARCHAR(255),
    shipper_id TEXT NULL,
    agent_id INT NULL,
    transhipment_port TEXT NULL,

    si_cut_off TIMESTAMP NULL,
    vgm_cut_off TIMESTAMP NULL,

    container_type_id INT NULL,
 
    
    loading_date TIMESTAMP NULL,
    feeder TEXT NULL,
    voy_feeder TEXT NULL,
    return_date TIMESTAMP NULL,
    vessel TEXT NULL,
    voy_vessel TEXT NULL,
    ETD_date TIMESTAMP NULL,
    ETA_date TIMESTAMP NULL,
    closing_date TIMESTAMP NULL,
    closing_time TIME NULL,
    depot_id INT NULL,
    gate_in_depot_id INT NULL,
    status TEXT NULL,
    draft_date TIMESTAMP ,
    sale_id INT NULL,
    remark TEXT NULL,
    prepared_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edit_by TEXT NULL,
    edit_date TIMESTAMP DEFAULT null ON UPDATE CURRENT_TIMESTAMP,

    pick_up_date TIMESTAMP NULL,
    loading_port TEXT NULL,
    first_container_return_date TIMESTAMP NULL,
    destination_port TEXT NULL,

);
