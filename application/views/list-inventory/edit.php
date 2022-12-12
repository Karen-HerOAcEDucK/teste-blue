<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Editar informações</h3>
            <p class="mb-1">Aqui você poderá editar as informações do computador do seu Inventário.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="m-0">Algumas informações são obrigatorias para que você consiga adicionar um novo computador.</p>
            <p class="text-danger m-0" style="font-size: 14px;"><strong>(*) - Campos Obrigatorios</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (has_alert()) : ?>
                <?php foreach (has_alert() as $type => $message) : ?>
                    <div class="col-md-12 mt-2">
                        <div class="alert <?= $type; ?> alert-dismissible fade show" role="alert">
                            <?= $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?= form_open("inventory/edit/{$fields['id']}", ["id" => "form-add-new-item-inventory"]) ?>
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-computer'></i> Marca do Computador <strong class='text-danger'>*</strong>", "input-brand-name") ?>
                    <?= form_input([
                        "ìd" => "input-brand-name",
                        "class" => "form-control",
                        "name" => "brand-name",
                        "required" => "required",
                        "placeholder" => "ex.: Acer",
                    ], $fields['brand_name']) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-display'></i> Model do Computador", "input-model") ?>
                    <?= form_input([
                        "ìd" => "input-model",
                        "class" => "form-control",
                        "name" => "model",
                        "placeholder" => "ex.: Nitro 5",
                    ], $fields['model_computer']) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-brands fa-creative-commons-zero'></i> Quantidade <strong class='text-danger'>*</strong>", "input-amount") ?>
                    <?= form_input([
                        "ìd" => "input-amount",
                        "class" => "form-control",
                        "name" => "amount",
                        "required" => "required",
                        "placeholder" => "ex.: 3"
                    ], $fields['amount']) ?>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-microchip'></i> Processador <strong class='text-danger'>*</strong>", "input-processor") ?>
                    <?= form_input([
                        "ìd" => "input-processor",
                        "class" => "form-control",
                        "name" => "processor",
                        "required" => "required",
                        "placeholder" => "ex.: Intel i5"
                    ], $fields['processor']) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-memory'></i> Memória RAM <strong class='text-danger'>*</strong>", "input-ram-memory") ?>
                    <?= form_input([
                        "ìd" => "input-ram-memory",
                        "class" => "form-control",
                        "name" => "ram-memory",
                        "required" => "required",
                        "placeholder" => "ex.: 16GB"
                    ], $fields['ram_memory']) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-hard-drive'></i> Armazenamento Interno <strong class='text-danger'>*</strong>", "input-storage") ?>
                    <?= form_input([
                        "ìd" => "input-storage",
                        "class" => "form-control",
                        "name" => "storage",
                        "required" => "required",
                        "placeholder" => "ex.: 500GB"
                    ], $fields['storage_computer']) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-box'></i> Tipo de Armazenamento", "input-storage-type") ?>
                    <?= form_input([
                        "ìd" => "input-storage-type",
                        "class" => "form-control",
                        "name" => "storage-type",
                        "placeholder" => "ex.: SSD"
                    ], $fields['storage_type']) ?>
                </div>
            </div>
            <input id="input-date-inventory" name="date-inventory" type="text" value="<?= $fields['date_inventory'] ?>" hidden>
        </div>
        <div class="row mt-4">
            <div class="d-flex flex-row justify-content-end">
                <button type="submit" class="btn btn-success" style="margin-right: 10px;">Salvar</button>
                <a href="<?= base_url("inventory/index") ?>" type="button" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    <?= form_close() ?>
</div>