<?php
$routeFk = 'target';
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $item
 */
$crumbs['admin'] = ['title' => 'Admin', 'url' =>  '/admin/dashboard'];
$crumbs['menu'] = ['title' => 'Menus', 'url' => '/admin/menus'];
$crumbs['item'] = ['title' => $menu->title, 'url' => ['action' => 'index', $routeFk  => $menu->id]];
$crumbs['action'] = ['title' => $this->request->getParam('action'), 'url' => null];
$this->viewVars['crumbs'] =  $crumbs;


$formFields['Opções'] = [
    'model' => ['options' => $models, 'empty' => true],
    'status' => ['options' => ['Unpublished', 'Published']],
    'parent_id' => ['options' => $parents, 'empty' => true],
];
$formFields['Attributos'] = [
    'attrs.icon' => ['options' => [], 'empty' => true],
    'attrs.divisor' => ['options' => ['before' => 'Antes', 'after' => 'Depois'], 'empty' => true],
];


$i = 0;
?>
<?= $this->Form->create($row); ?>
<div class="card shadow">
    <div class="card-header btn-group-sm">
        <?= $this->element('Bootstrap4/btn/save'); ?>
        <?= $this->element('Bootstrap4/btn/apply'); ?>
        <?= $this->element('Bootstrap4/btn/cancel', ['url' => $crumbs['item']['url']]); ?>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="col-8">
                <?php
                echo $this->Form->hidden('menu_id', ['value' => (string) $menu->id]);
                echo $this->Form->hidden('user_id', ['value' => (string) empty($userData->id) ? '' : $userData->id]);
                echo $this->Form->control('title', ['type' => 'text']);
                echo $this->Form->control('slug', ['type' => 'text']);
                echo $this->Form->search('link', ['button' => ['title' => __('search'), 'icon' => 'search', 'data-target' => '#searchModal', 'data-toggle' => 'modal']]);
                ?>
            </div>
            <div class="col-4" id="accordion">
                <div class="accordion">
                    <?php foreach ($formFields as $legend => $fields) : $legend_slug = ucfirst(strtolower($this->Text->slug($legend))) ?>
                        <div class="card">
                            <div class="card-header p-0 m-0" id="heading<?= $legend_slug ?>">
                                <button class="btn btn-link btn-block text-left rounded-0 border-0" type="button" data-toggle="collapse" data-target="#collapse<?= $legend_slug ?>" aria-expanded="true" aria-controls="collapse<?= $legend_slug ?>">
                                    <?= $legend ?>
                                </button>
                            </div>
                            <div id="collapse<?= $legend_slug ?>" class="collapse<?= $i == 0 ? ' show' : '' ?>" aria-labelledby="heading<?= $legend_slug ?>" data-parent="#accordion">
                                <div class="card-body py-1">
                                    <?= $this->Form->controls($fields, ['legend' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end(); ?>




<?php
$crumbs['item']['url']['action'] = 'links';
?>
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalCenterTitle">Links</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalWrapper">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<iframe id="iframe1" src="<?= $this->Url->build($crumbs['item']['url']) ?>"></iframe>
<?php $this->start('script') ?>
<script type="text/javascript">
    $(document).ready(function() {
        var input = $('input[name="link"]');
        var iframe = $('#iframe1');
        var target = $('#modalWrapper');
        var query = function(url, key, value) {
            var regex = new RegExp(key + '\\=(.*)', 'g');
            if (regex.test(url)) {
                return url.replace(regex, key + '=' + value);
            } else {
                return url + (/\?/.test(url) ? '&' : '?') + key + '=' + value;
            }
            return url;
        }

        var inputValue = input.val();
        if (inputValue) {
            iframe.attr('src', query(iframe.attr('src'), 'link', inputValue));
        }

        iframe.on('load', function(e) {

            var cont = $(this).contents();
            var body = cont.find('#frame_links');
            var iframeLocation = cont.get(0).location;

            inputValue = input.val();
            if (!target.hasClass('rendered')) {
                target = target.html(body.html()).addClass('rendered')
            }

            if (target.has('input[value="' + inputValue + '"]')) {
                target.find('input[value="' + inputValue + '"]').prop('checked', true).addClass('bg-info')
            }

            target
                .find('input[type="radio"]')
                .on('change', function(e) {
                    input.val(this.value)
                    iframeLocation.href = query(iframeLocation.href, 'link', this.value);
                });
        });

    });
</script>
<?php $this->end() ?>