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
                        <i class="fa fa-check-square-o mr-2"></i>
                        Top Know height
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['topKnowHeight'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Difficulty for the next block, the ratio at which the current hashing speed blocks will be mined, including a 4 minutes interval">
                    <span>
                        <i class="fa fa-bolt mr-2"></i>
                        Syncronized
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo $status['isSync'] ? 'Yes' : 'No' ?></span>
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
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info">3 s (no transation 3600s)</span>
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
                        <i class="fa fa-globe mr-2"></i>
                        Peers
                    </span>
                    <span id="network-next-difficulty" class="value d-inline-block float-right text-info"><?php echo count($status['peersPersistence']); ?></span>
                </li>

            </ul>
        </div>
        <div class="col-12 col-lg-4">
            <ul class="list-group mb-0">

                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Total transaction
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info"><?php echo $status['totalTransaction'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Total transfer
                    </span>
                    <span id="avg-hash-rate" class="value d-inline-block float-right text-info"><?php echo $status['totalTransfer'] ?></span>
                </li>
                <li class="list-group-item" data-toggle="tooltip" data-placement="top" data-original-title="Average estimated network hash rate, calculated by average difficulty">
                    <span>
                        <i class="fa fa-exchange mr-2"></i>
                        Total
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
<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Pool <span class="badge badge-info pull-right"><?php echo $transactionsPool['count'] ?> transactions</span>
  </div>
  <div class="card-body">
    <?php if ($transactionsPool['count']): ?>
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">From</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Fee</th>
                <th class="text-center">Hash</th>
            </tr>
            <?php foreach ($transactionsPool['transactions'] as $transaction): ?>
            <tr>
                <td class="align-center">
                    <?php echo $transaction['createdAt']; ?>
                </td>
                <td class="align-center">
                    <a href="?wallet=<?php echo $transaction['from']; ?>">
                        <?php echo $transaction['from']; ?>
                    </a>
                </td>
                <td class="align-center"><?php echo ($transaction['amount'] / 1000000000); ?></td>
                <td class="align-center"><?php echo ($transaction['fee'] / 1000000000); ?></td>
                <td class="align-center">
                    <div class="truncate"><?php echo $transaction['hash']; ?></div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>


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
                <td style="text-align: right;"><?php echo date(DATE_RFC2822, (int)$block['createdAt']); ?></td>
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
            <?php foreach ($domains['domainList'] as $domain): ?>
            <tr>
                <td class="text-center">
                    <a href="?block-height=<?php echo $domain['blockHeight']; ?>">
                        <?php echo $domain['blockHeight'] ?>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
<script type="text/javascript">

  var data = {
    datasets: [{
      label: 'Height',
      data: [],
      borderColor: 'red',
      fill: false,
    }]
  };

  <?php foreach ($blocks as $block) { ?>
    data.datasets[0].data.push({
      t: moment.unix(<?php echo $block['createdAt']; ?>).format("DD-MM-YYYY HH:mm:ss"),
      y: <?php echo $block['height'] ?>
    });
  <?php } ?>

  var timeFormat = 'DD/MM/YYYY h:mm:ss a';

  var config = {
      type:    'line',
      data:    data,
      options: {
          responsive: true,
          scales:     {
              xAxes: [{
                  type:       "time",
                  time:       {
                      format: timeFormat,
                      tooltipFormat: 'll'
                  },
                  scaleLabel: {
                      display:     true,
                      labelString: 'Date'
                  }
              }],
              yAxes: [{
                  scaleLabel: {
                      display:     true,
                      labelString: 'value'
                  }
              }]
          }
      }
  };

  window.onload = function () {
      var ctx       = document.getElementById("inescoinChart").getContext("2d");



      window.myLine = new Chart(ctx, config);
  };

</script>


