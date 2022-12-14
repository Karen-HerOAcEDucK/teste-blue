<div class="container-fluid">
    <div class="d-flex flex-row justify-content-between">
        <div>
            <h3>Listagem de Diretórios Linux</h3>
        </div>
    </div>
    <div class="row mt-4">
        <?= form_open("listDirectories", ["id" => "form-file-path"]) ?>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label("<i class='fa-solid fa-computer'></i> Caminho para exibição", "input-file-path") ?>
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="col-md-5" style="margin-right: 15px;">
                                <?= form_input([
                                    "ìd" => "input-file-path",
                                    "class" => "form-control",
                                    "name" => "file-path",
                                    "required" => "required",
                                    "placeholder" => "ex.: C:\Users\karen\Documentos",
                                ], set_value('file-path')) ?>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Exibir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?= form_close() ?>
    </div>
    <?php if(!empty($contentsPath)): ?>
        <div class="div-table mt-4">
            <table class="table" id="table-items">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">Diretorios</th>
                        <th class="text-center" scope="col">Arquivos</th>
                    </tr>
                </thead>
                <tbody id="table-body-items">
                    <?php foreach ($contentsPath as $contentPath) : ?>
                        <?php if($contentPath[0] == '.' || $contentPath[0] == '..'):
                            continue;
                        endif; ?>
                        <?php if($contentPath[1] == 'dir'): ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $contentPath[0] ?></th>
                                <th scope="row" class="text-center"> - </th>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <th scope="row" class="text-center"> - </th>
                                <th scope="row" class="text-center"><?= $contentPath[0] ?></th>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="row mt-5">
            <div class="col-md-12">
                <h5>Nenhum caminho informado para realizar a exibição.</h5>
            </div>
        </div>
    <?php endif; ?>
</div>