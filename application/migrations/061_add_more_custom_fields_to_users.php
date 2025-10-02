<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_more_custom_fields_to_users extends EA_Migration
{
    private const FROM = 6;   // start at 6
    private const TO   = 12;  // extend to 12

    public function up(): void
    {
        for ($i = self::FROM; $i <= self::TO; $i++) {
            $field = 'custom_field_' . $i;

            if (!$this->db->field_exists($field, 'users')) {
                $this->dbforge->add_column('users', [
                    $field => [
                        'type' => 'TEXT',
                        'null' => true,
                        'after' => 'custom_field_' . ($i - 1),
                    ],
                ]);
            }
        }
    }

    public function down(): void
    {
        for ($i = self::TO; $i >= self::FROM; $i--) {
            $field = 'custom_field_' . $i;

            if ($this->db->field_exists($field, 'users')) {
                $this->dbforge->drop_column('users', $field);
            }
        }
    }
}
