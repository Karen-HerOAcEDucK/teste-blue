<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Adicionar um novo Item ao Inventário.</h3>
            <p class="mb-1">Aqui você irá inserir um novo computador ao seu Inventário.</p>
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
    <?= form_open("inventory/new", ["id" => "form-add-new-item-inventory"]) ?>
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
                    ], set_value('brand-name')) ?>
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
                    ], set_value('model')) ?>
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
                    ], set_value('amount')) ?>
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
                    ], set_value('processor')) ?>
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
                    ], set_value('ram-memory')) ?>
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
                    ], set_value('storage')) ?>
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
                    ], set_value('storage-type')) ?>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="d-flex flex-row justify-content-end">
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>
        </div>
    <?= form_close() ?>
</div>