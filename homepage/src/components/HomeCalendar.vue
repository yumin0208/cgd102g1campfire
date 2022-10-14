<template>
  <a-calendar v-model:value="value">
    <template #headerRender="{ value }">
      <div class="whatPick">
        <span>{{ whatChoose.areaChoose[whichArea - 1] }}</span
        ><span>{{ whatChoose.peopleChoose[howMany - 1] }}</span
        ><span>{{ whatChoose.typeChoose[whichType - 1] }}</span>
      </div>
      <div class="calendar_header">
        <button type="button" @click="preMonth">
          <img src="../assets/images/booking/booking_arrow_prev.png" alt="" />
        </button>
        <div class="now_days">
          {{ new Date(value).getFullYear() }} 年
          {{ new Date(value).getMonth() + 1 }}月
        </div>
        <button type="button" @click="nextMonth">
          <img src="../assets/images/booking/booking_arrow_next.png" alt="" />
        </button>
      </div>
    </template>
    <template #dateCellRender="{ current }">
      <ul class="events">
        <!-- <li v-for="item in getListData(current)" :key="item.content">
          <a-badge :status="item.type" :text="item.content" />
        </li> -->
        <div class="date_content">可預訂</div>
        <div class="date_result_left">
          <span>{{ 5 - getListData2(current) }}</span
          >間
        </div>

        <!-- <li v-for="(item, idx) in getListData2(current)" :key="idx">
          {{ item }}
        </li> -->
      </ul>
    </template>
  </a-calendar>
</template>
<script>
import dayjs from 'dayjs';
import { defineComponent, ref } from 'vue';
export default defineComponent({
  props: ['whichArea', 'howMany', 'whichType'],
  data() {
    return {
      value: dayjs(),
      originData: [
        {
          checkIn: '2022-10-11',
          checkOut: '2022-10-13',
        },
        {
          checkIn: '2022-10-10',
          checkOut: '2022-10-16',
        },
        {
          checkIn: '2022-10-05',
          checkOut: '2022-10-13',
        },
        {
          checkIn: '2022-10-14',
          checkOut: '2022-10-22',
        },
        {
          checkIn: '2022-10-11',
          checkOut: '2022-10-13',
        },
      ],
      whatChoose: {
        areaChoose: ['叢林歷險', '冰雪奇緣', '荒野峽谷'],
        peopleChoose: ['', '二人營帳', '', '四人營帳', '', '六人營帳'],
        typeChoose: ['經濟營帳', '豪華營帳', '主題營帳'],
      },
    };
  },
  computed: {
    sortData() {
      let result = [];
      this.originData.forEach((v) => {
        const checkIn = new Date(v.checkIn);
        const checkOut = new Date(v.checkOut);
        const time = checkOut.getTime() - checkIn.getTime();
        const days = Math.ceil(time / (1000 * 3600 * 24)) + 1;
        for (let i = 0; i < days; i++) {
          let currentDate = new Date(v.checkIn);
          currentDate.setDate(currentDate.getDate() + i);
          const currentDateAfterFormat = `${currentDate.getFullYear()}-${
            currentDate.getMonth() + 1
          }-${currentDate.getDate()}`;
          const sameDateIndex = result.findIndex(
            (u) => u.date == currentDateAfterFormat
          );
          if (sameDateIndex > -1) {
            result[sameDateIndex].times += 1;
          } else
            result.push({
              date: currentDateAfterFormat,
              times: 1,
            });
        }
      });
      return result;
    },
  },
  methods: {
    getBookedInfo() {
      fetch(
        process.env.VUE_APP_PHP_PATH +
          `bookedSearch.php?whatMonth='${this.value.year()}-${
            this.value.month() + 1
          }'&areaNoGet=${this.whichArea}&howManyPeopleGet=${
            this.howMany
          }&whichTentType=${this.whichType}`
      )
        .then((response) => {
          if (response) {
            this.fetchError = response.status !== 200;
            //json(): 返回 Promise，resolves 是 JSON 物件
            return response.json();
          }
        })
        .then((responseText) => {
          console.log(responseText);
          this.originData = responseText;
        })
        .catch((err) => {
          this.originData = [];
        });
    },
    getListData2(date) {
      const sameDate = this.sortData.find((v) => {
        const itemDate = new Date(v.date);
        return (
          itemDate.getFullYear() === new Date(date).getFullYear() &&
          itemDate.getMonth() === new Date(date).getMonth() &&
          itemDate.getDate() === new Date(date).getDate()
        );
      });
      return sameDate?.times ?? 0;
    },

    async nextMonth() {
      let value = this.value;
      this.value = value.month(value.month() + 1);
      await this.getBookedInfo();
    },
    async preMonth() {
      let value = this.value;
      if (value.year() == dayjs().year()) {
        if (value.month() > dayjs().month()) {
          this.value = value.month(value.month() - 1);
          await this.getBookedInfo();
          return;
        } else {
          return;
        }
      } else if (value.year() > dayjs().year()) {
        this.value = value.month(value.month() - 1);
        await this.getBookedInfo();
        return;
      } else {
        return;
      }
    },
  },
  created() {
    this.getBookedInfo();
  },
  watch: {
    calendarTrigger(e) {
      this.$emit('calendar-trigger-result', e);
    },
  },
});
</script>
<style lang="scss" scoped>
.events {
  list-style: none;
  margin: 0;
  padding: 0;
  .date_content {
    color: #8dccb9;
  }
  .date_result_left {
    span {
      font-size: 20px;
      color: #bc6c61;
      padding: 5px;
    }
  }
}
.events .ant-badge-status {
  overflow: hidden;
  white-space: nowrap;
  width: 100%;
  text-overflow: ellipsis;
  font-size: 12px;
}

.calendar_header {
  text-align: center;
  padding: 20px 0;
}
.whatPick {
  margin: auto;
  text-align: center;
  padding: 20px 0 0 0;
  span {
    font-size: 20px;
    font-weight: 600;
    padding: 0 5px;
    color: #168d80;
  }
}
@media screen and (max-width: 767px) {
  .whatPick {
    span {
      font-size: 16px;
      font-weight: 400;
    }
  }
  .events {
    .date_content {
      font-size: 12px;
      color: #8dccb9;
    }
    .date_result_left {
      span {
        font-size: 16px;
      }
    }
  }
}
</style>
