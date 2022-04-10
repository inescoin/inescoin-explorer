<div class="card mt-5">
  <div class="card-header">
    <i class="fa fa-heartbeat"></i> Stats
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-12 col-lg-4">
            <ul class="list-group mb-0">
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Blockchain height, representing the total amount of blocks, starting from zero">
                    <span>
                        <i class="fa fa-list-ol mr-2"></i>
                        Height
                    </span>
                    <span id="network-height" class="value d-inline-block float-right text-info"><?php echo $status['height'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Difficulty for the next block, the ratio at which the current hashing speed blocks will be mined, including a 4 minutes interval">
                    <span>
                        <i class="fa fa-unlock-alt mr-2"></i>
                        Difficulty
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['cumulativeDifficulty'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Difficulty for the next block, the ratio at which the current hashing speed blocks will be mined, including a 4 minutes interval">
                    <span>
                        <i class="fa fa-bolt mr-2"></i>
                        Syncronized
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['bankValid'] ? 'Yes' : 'No' ?></span>
                </li>
            </ul>
        </div>
        <div class="col-12 col-lg-4">
            <ul class="list-group mb-0">
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-history mr-2"></i>
                        Est. solve time
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info">3 s (without tx 3600s)</span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Difficulty for the next block, the ratio at which the current hashing speed blocks will be mined, including a 4 minutes interval">
                    <span>
                        <i class="fa fa-check-square-o mr-2"></i>
                        Domains
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['totalDomains'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Difficulty for the next block, the ratio at which the current hashing speed blocks will be mined, including a 4 minutes interval">
                    <span>
                        <i class="fa fa-globe mr-2"></i>
                        Wallets
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['bankAdresses']; ?></span>
                </li>

            </ul>
        </div>
        <div class="col-12 col-lg-4">
            <ul class="list-group mb-0">

                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Transactions
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info"><?php echo $status['totalTransactions'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Transfers
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info"><?php echo $status['totalTransfers'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Coins
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info"><?php echo $status['bankAmount'] / 1000000000 ?> INES</span>
                </li>
            </ul>
        </div>
    </div>
  </div>
</div>

<div class="card mt-5">
  <div class="card-header">
    <i class="fa fa-area-chart"></i> Chart
  </div>
  <div class="card-body">
    <canvas id="inescoinChart" width="400" height="200"></canvas>
  </div>
</div>
<?php if ($transactionsPool['count']): ?>
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Pool <span class="badge badge-info"><?php echo $transactionsPool['count'] ?></span>
  </div>
  <div class="card-body">
    <table class="table table-responsive w-100">
        <tbody>
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">From</th>
                <th class="text-center">To</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Reference</th>
            </tr>
            <?php foreach ($transactionsPool['transactions'] as $transaction): ?>
            <tr style="background: #CCC;">
                <td class="align-center">
                    <?php echo date('Y-m-d H:i:s', (int) $transaction['createdAt']); ?>
                </td>
                <td class="align-center">
                    <a href="?wallet=<?php echo $transaction['fromWalletId']; ?>">
                        <div class="truncate"><?php echo $transaction['fromWalletId']; ?></div>
                    </a>
                </td>
                <td class="align-center">
                </td>
                <td class="align-center"><?php echo ($transaction['amountWithFee'] / 1000000000); ?> <small>INES</small></td>
                <td class="align-center">
                    -
                </td>
            </tr>
            <?php foreach ($transaction['transfers'] as $transfer): ?>
                <tr>
                    <td class="align-center">
                                            </td>
                    <td class="align-center">
                                            </td>
                    <td class="align-center">
                        <a href="?wallet=<?php echo $transfer['toWalletId']; ?>">
                            <div class="truncate"><?php echo $transfer['toWalletId']; ?></div>
                        </a>
                    </td>
                    <td class="align-center"><?php echo ($transfer['amount'] / 1000000000); ?> <small>INES</small></td>

                    <td class="align-center"><?php echo $transfer['reference']; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

  </div>
</div>
<?php endif; ?>

<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-cubes" aria-hidden="true"></i> Recent blocks
  </div>
  <div class="card-body">
    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="/?page=<?php echo $pagination['previous'] ?>">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="/?page=<?php echo $pagination['next'] ?>">Next</a>
        </li>
    </ul>
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th class="text-center">Height</th>
                <th class="text-center">Hash</th>
                <th class="text-center">TX count</th>
                <th class="text-center">Cumulative Difficulty</th>
                <th class="text-center">Nonce</th>
                <th class="text-center">Date</th>
            </tr>
            <?php foreach ($blocks as $block): ?>
            <tr>
                <td class="text-center">
                    <a href="?block-height=<?php echo $block['height']; ?>">
                        <?php echo $block['height'] ?>
                    </a>
                </td>
                <td class="text-center">
                    <a href="?block-hash=<?php echo $block['hash']; ?>">
                        <div class="txt-300 text-wrap"><?php echo $block['hash'] ?></div>
                    </a>
                </td>
                <td class="text-center">
                    <?php echo count($block['data']); ?>
                </td>
                <td class="text-center">
                    <?php echo $block['cumulativeDifficulty']; ?>
                </td>
                <td class="text-center">
                    <?php echo $block['nonce']; ?>
                </td>
                <td style="text-align: right;"><?php echo date('Y-m-d H:i:s', (int)$block['createdAt']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="/?page=<?php echo $pagination['previous'] ?>">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="/?page=<?php echo $pagination['next'] ?>">Next</a>
        </li>
    </ul>
  </div>
</div>

<?php if (!empty($domains)): ?>
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-globe" aria-hidden="true"></i> Recent domains
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th class="text-center">Height</th>
                <th class="text-center">Hash</th>
                <th class="text-center">Name</th>
                <th class="text-center">Transaction hash</th>
            </tr>
            <?php foreach ($domains as $domain): ?>
            <tr>
                <td class="text-center">
                    <a href="?block-height=<?php echo $domain['height']; ?>">
                        <?php echo $domain['height'] ?>
                    </a>
                </td>
                <td class="text-center">
                    <div class="txt-300 text-wrap"><?php echo $domain['hash'] ?></div>
                </td>
                <td class="text-center">
                  <a href="?domain=<?php echo $domain['url']; ?>">
                    <?php echo $domain['url']; ?>
                  </a>
                </td>
                <td class="text-center">
                    <a href="?transaction=<?php echo $domain['transactionHash']; ?>">
                      <?php echo $domain['transactionHash']; ?>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script type="text/javascript">

  var data = {
    datasets: [{
         type: 'line',
          label: 'Transactions',
          data: [
            <?php foreach ($blocks as $block) { ?>
            { x: <?php echo $block['createdAt']; ?> * 1000, y: <?php echo $block['countTransaction'] ?> },
            <?php } ?>
          ],
          borderColor: 'green',
          fill: false,
        },{
            type:    'line',
          label: 'Height',
          data: [
            <?php foreach ($blocks as $block) { ?>
            { x: <?php echo $block['createdAt']; ?> * 1000, y: <?php echo $block['height'] ?> },
            <?php } ?>
          ],
          borderColor: 'red',
          fill: false,
          yAxisID: 'y',
        },{
          label: 'Difficulty',
          data: [
            <?php foreach ($blocks as $block) { ?>
            { x: <?php echo $block['createdAt']; ?> * 1000, y: <?php echo $block['cumulativeDifficulty'] ?>},
            <?php } ?>
          ],
          borderColor: 'blue',
          fill: false,
          yAxisID: 'y1',
    }]
  };

  var timeFormat = 'DD/MM/YYYY h:mm:ss a';

  var config = {
        type:    'line',
      data:    data,
      options: {
        responsive: true,
        scales:     {
          x: {
            type: 'time',
            time: {
                parser: timeFormat,
                unit: "<?php echo count($blocks) > 50 ? 'minute' : 'day' ?>"
            },
            display: true,
            title: {
              display: true,
              text: 'Date'
            }
          },
          y: {
            type: 'linear',
            display: true,
            position: 'left',
            title: {
              display: true,
              text: 'Height'
            }
          },
          y1: {
            type: 'linear',
            display: true,
            position: 'right',
            title: {
              display: true,
              text: 'Difficulty'
            }
          }
        }
      }
  };

  window.onload = function () {
      var ctx       = document.getElementById("inescoinChart").getContext("2d");
      window.myLine = new Chart(ctx, config);
  };

</script>


