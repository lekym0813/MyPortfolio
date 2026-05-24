<!-- Bill Calculator -->
<div class="section section-light" id="billCalculator">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="text-primary-pw font-weight-bold">Bill Calculator</h2>
      <p class="text-muted">Estimate your monthly water bill based on consumption</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="calculator-card">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer Classification</label>
                <select class="form-control" id="calcClassification" onchange="calculateBill()">
                  <option value="24.50">Residential — ₱24.50/m³</option>
                  <option value="30.70">Commercial — ₱30.70/m³</option>
                  <option value="40.20">Bulk/Wholesale — ₱40.20/m³</option>
                </select>
              </div>
              <div class="form-group">
                <label>Consumption (m³)</label>
                <input type="number" class="form-control" id="calcConsumption" min="0" step="0.1" placeholder="Enter usage in cubic meters" oninput="calculateBill()" value="0">
              </div>
              <button class="btn-pw btn-pw-orange btn-pw-lg btn-block" onclick="calculateBill()">Calculate</button>
            </div>
            <div class="col-md-6">
              <div class="calc-result" id="calcResult">
                <h5 class="text-center text-muted mb-0">Estimated Bill</h5>
                <hr>
                <div class="calc-result-row">
                  <span>Classification:</span>
                  <span id="resultClassification" class="text-primary-pw">Residential</span>
                </div>
                <div class="calc-result-row">
                  <span>Rate per m³:</span>
                  <span id="resultRate">₱24.50</span>
                </div>
                <div class="calc-result-row">
                  <span>Consumption:</span>
                  <span id="resultConsumption">0 m³</span>
                </div>
                <div class="calc-result-row">
                  <span>Basic Charge:</span>
                  <span id="resultBasic">₱0.00</span>
                </div>
                <div class="calc-result-row">
                  <span>VAT (12%):</span>
                  <span id="resultVat">₱0.00</span>
                </div>
                <hr>
                <div class="calc-result-row calc-total">
                  <span>TOTAL AMOUNT DUE:</span>
                  <span id="resultTotal">₱0.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <p class="text-center text-muted mt-3" style="font-size: 12px;">
          <i class="fas fa-info-circle"></i> This is an estimate only. The actual bill may vary.
        </p>
      </div>
    </div>
  </div>
</div>

<script>
function calculateBill() {
  var rate = parseFloat(document.getElementById('calcClassification').value) || 0;
  var consumption = parseFloat(document.getElementById('calcConsumption').value) || 0;
  var sel = document.getElementById('calcClassification');
  var classificationText = sel.options[sel.selectedIndex].text.split(' — ')[0];

  var basic = consumption * rate;
  var vat = basic * 0.12;
  var total = basic + vat;

  document.getElementById('resultClassification').textContent = classificationText;
  document.getElementById('resultRate').textContent = '₱' + rate.toFixed(2);
  document.getElementById('resultConsumption').textContent = consumption + ' m³';
  document.getElementById('resultBasic').textContent = '₱' + basic.toFixed(2);
  document.getElementById('resultVat').textContent = '₱' + vat.toFixed(2);
  document.getElementById('resultTotal').textContent = '₱' + total.toFixed(2);
}
</script>
