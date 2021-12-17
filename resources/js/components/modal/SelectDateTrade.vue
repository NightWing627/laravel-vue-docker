<template>

  <form
    method="get"
    :action="postURL"
    enctype="multipart/form-data"
  >
    <p class="u-color--grayNavy u-text--small">
      <a @click="showModal">
        取引履歴をCSVファイルでダウンロード
      </a>
    </p>
    <div
      v-show="isExportModal"
      ref="date_select_modal"
      class="date-select-modal"
      @click.self="closeModal"
    >
      <div class="date-select-modal-inner">
        <div class="l-content--detail">
          <div class="l-content--detail__inner">
            <div class="l-wrap--title p-0">
              <h1 class="c-headline--screen">
                Select Date Range
              </h1>
              <button
                type="button"
                class="close-modal"
                @click="closeModal"
              >
              </button>
            </div>
          
            <div class="l-content--input">
              <div class="l-flex trade-date-content">
                <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                  <div class="l-content--input__headline">
                    Start Date
                  </div>
                  <vue-datepicker
                    v-model="startDate"
                    type="date"
                    name="startDate"
                    :format="customFormatter"
                    :language="ja"
                    @closed="startPickerClosed"
                  />
                </div>
                <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                  <div class="l-content--input__headline">
                    End Date
                  </div>
                  <vue-datepicker
                    v-model="endDate"
                    type="date"
                    name="endDate"
                    :format="customFormatter"
                    :language="ja"
                    @closed="endPickerClosed"
                  />
                </div>
              </div>
            </div>
            <div class="l-button--submit">
              <button
                type="submit"
                class="c-button--square__pink"
                @click="exportExcel"
              >
                Export Excel
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
  import moment from "moment"
  import 'moment/locale/ja'
  import VueDatepicker from 'vuejs-datepicker'
  import VueTimepicker from 'vue2-timepicker'
  import 'vue2-timepicker/dist/VueTimepicker.css'
  import {ja} from 'vuejs-datepicker/dist/locale'

  export default {
    components: {
      'vue-datepicker': VueDatepicker,
      'vue-timepicker': VueTimepicker,
    },
    data() {
      return {
        ja:ja,
        startDate: '',
        endDate: '',
        highlighted: {
          to: new Date
        },
        isExportModal: false,
        postURL: '/mypage/t/trade/excel/export',
      }
    },
    // computed: {
    //   // レッスン追加のバリデーションチェック
    //   checkExportSubmit: function() {
    //       return true
    //   }
    // },
    methods: {
      // 開始日のフォーマット
      customFormatter: function(date) {
        return moment(date).format('YYYY/MM/DD')
      },
      // Datapickerを閉じる処理
      startPickerClosed: function() {
        if(this.startDate){
          this.startDate = moment(this.startDate).format('YYYY/MM/DD');
        }
      },
      endPickerClosed: function() {
        if(this.endDate){
          this.endDate = moment(this.endDate).format('YYYY/MM/DD');
        }
      },
      // モーダル：表示
      showModal: function() {
        if (this.isExportModal) {
          this.isExportModal = false;
        } else {
          this.isExportModal = true;
        }
        
      },
      // モーダル：非表示
      closeModal: function() {
        // モーダルを閉じる
        this.isExportModal = false;
        this.$refs.date_select_modal.scrollTop = 0
      },
      
      exportExcel: function(e) {
        console.log(this.startDate);
        console.log(this.endDate);
        if (!this.startDate) {
          alert('please select start date');
          e.preventDefault();
        }

        if (new Date(this.endDate) < new Date(this.startDate)) {
          alert('please select end date bigger than start date');
          e.preventDefault();
        }
        this.postURL = '/mypage/t/excel/export';
        return true;
     }
    }
  }
</script>
