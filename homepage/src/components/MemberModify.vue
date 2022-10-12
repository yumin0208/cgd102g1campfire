<template>
    <div class="mem_content_group">
        <h3>編輯會員資料</h3>
        <form class="mem_form" method="POST" enctype="multipart/form-data">
            <div class="tabcontent_text_group">
                <div class="tabcontent_txt_group">
                    <ul class="tabcontent_txt">
                        <li>
                            <label for="mem_name" class="tab_label">
                                <p>會員姓名</p>
                            </label>
                        </li>                    
                        <li>
                            <label for="mem_nick_name" class="tab_label">
                                <p>暱稱</p>
                            </label>
                        </li>
                        <li>
                            <label for="mem_email" class="tab_label">
                                <p>E-mail</p>
                            </label>
                        </li>
                        <li>
                            <label for="mem_tel" class="tab_label">
                                <p>電話</p>
                            </label>
                        </li> 
                    </ul>
                    <ul class="tabcontent_txt">
                        <li>
                            <input id="mem_name" name="name" class="input_box" type="text" v-model="mem_name"/>
                        </li>
                        <li>
                            <input id="mem_nick_name" class="input_box" type="text" v-model="mem_nick_name"/>
                        </li>
                        <li>
                            <input id="mem_email" name="email" class="input_box" type="email" v-model="mem_email" />
                        </li>
                        <li>
                            <input id="mem_tel" class="input_box" type="tel" v-model="mem_phone"/>
                        </li>
                    </ul>
                </div>
                <div class="tabcontent_txt_group">
                    <ul class="tabcontent_txt">
                        <li>
                            <label class="tab_label" for="">
                            <p>縣市</p></label>
                        </li>
                        <li>
                            <label class="tab_label" for=""><p>地址</p></label>
                        </li>
                    </ul>
                    <ul class="tabcontent_txt">
                        <li>
                            <select  class="menu_choose" v-model="mem_city">
                                <option value=""></option>
                                <option v-for="i in city" :key="i">{{i}}</option>
                            </select>
                        </li>
                        <li>
                            <input  class="input_box input_addr" type="text" v-model="mem_addr" />
                        </li>
                    </ul>
                </div>
            </div>
            <h4>選取大頭貼</h4>
            <ul class="tabcontent_img">
                <li>
                    <label for="sloth" class="select_img">
                        <input type="radio" id="sloth" name="namepic" class="input_none" value="1" v-model="mem_pic" :checked="mem_pic==1">
                        <img src="@/assets/images/report/report_avatar_1.png" >
                    </label>
                </li>
                <li>
                    <label for="bear" class="select_img">
                        <input type="radio" id="bear" name="namepic" class="input_none" v-model="mem_pic" value="2" :checked="mem_pic==2">
                        <img src="@/assets/images/report/report_avatar_2.png" >
                    </label>
                </li>
                <li>
                    <label for="fox" class="select_img">
                        <input type="radio" id="fox" name="namepic" class="input_none" value="3" v-model="mem_pic" :checked="mem_pic==3">
                        <img src="@/assets/images/report/report_avatar_3.png">
                    </label>
                </li>
                <li>
                    <label for="snake" class="select_img">
                        <input type="radio" id="snake" name="namepic" class="input_none" value="4" v-model="mem_pic" :checked="mem_pic==4">
                        <img src="@/assets/images/report/report_avatar_4.png" >
                    </label>
                </li>
                <li>
                    <label for="penguin" class="select_img">
                        <input type="radio" id="penguin" name="namepic" class="input_none" value="5" v-model="mem_pic" :checked="mem_pic==5">
                        <img src="@/assets/images/report/report_avatar_5.png" >
                    </label>
                </li>
                <li>
                    <label for="dinosaur" class="select_img" >
                        <input type="radio" id="dinosaur" name="namepic" class="input_none" value="6" v-model="mem_pic" :checked="mem_pic==6">
                        <img src="@/assets/images/report/report_avatar_6.png">
                    </label>
                </li>
            </ul>
            <button class="btn_confirm" type="submit" id="submit" @click="update">儲存</button>
        </form>
    </div>
</template>

<script>
import { useRouter } from "vue-router";
export default {
    name: "MemberModify",
    created(){
        this.getMemData()
        this.fetchMemData()
    },
    data(){
        return {
            city:[
                '台北市','新北市','桃園市','台中市','台南市','高雄市','基隆市','新竹市','嘉義市','新竹縣','苗栗縣','彰化縣','南投縣','雲林縣','嘉義縣','屏東縣','宜蘭縣','花蓮縣','台東縣','澎湖縣','金門縣','連江縣'
            ],

            selected: '',
            memmodifydata:{},
            memId: '',
            memdata:'',
            member:'',
            mem_id:'',
            mem_name:'',
            mem_email:'',
            mem_nick_name:'',
            mem_city:'',
            mem_addr:'',
            mem_phone:'',
            mem_pic:'',
            mem_deta:[],
            router:useRouter()
        }
    },
    methods:{
        getMemData(){
            //抓到sessionStorage的會員資料
            this.member = JSON.parse(sessionStorage.getItem('member'));
            //抓取會員id，要去後端撈會員資料需要
            this.mem_id = this.member.mem_id;
            //確認有抓到東西
            console.log(this.member)
            console.log(this.mem_id)
        },
        fetchMemData(){
            console.log(this.mem_id)
            fetch(process.env.VUE_APP_PHP_PATH + `membermodifytest.php?memId=${this.mem_id}`)                
            .then((response) => {
                this.fetchError = (response.status !== 200)
            //json(): 返回 Promise，resolves 是 JSON 物件
                return response.json()
            }).then(responseText => {
                console.log(responseText)
                //傳送資料
                const useData = responseText
                //篩選會員id之後撈回來的第一筆資料
                this.memmodifydata = useData[0]
                //這邊的mem_xxx資料是綁在v-model上
                this.mem_name = responseText.mem_name;
                this.mem_email = responseText.mem_email;
                this.mem_nick_name = responseText.mem_nick_name;
                this.mem_city = responseText.mem_city;
                this.mem_addr = responseText.mem_addr;
                this.mem_phone = responseText.mem_phone;
                this.mem_pic = responseText.mem_pic;
            }).catch((err) => {
                this.memmodifydata = true
            });
        },
        update(e){
            if (
                //指定css選擇器的節點
                e.target.closest('button') &&
                e.target.closest('button').id === 'submit'
                ) {
                //取消預設submit事件
                    e.preventDefault()
                //設定判斷式
                const emailFormat = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/ ;
                if(this.mem_name == '' || this.mem_nick_name == '' || this.mem_city == ''|| this.mem_addr == '' || this.mem_phone == ''){
                    alert("有欄位空白");
                    return;
                }
                else if(this.mem_email.search(emailFormat)!=0){
                    alert("信箱格式錯誤");
                    return;
                }
                else if(this.mem_pic == ''){
                    alert("請選擇大頭貼");
                    return;
                }
                else{
                //沒有錯誤則將更新後的會員傳送到資料庫
                    var xhr = new XMLHttpRequest();
            
                    xhr.open("POST",process.env.VUE_APP_PHP_PATH + 'updatemember.php', true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    //回傳過去的資料
                    let mem_deta = `mem_id=${this.mem_id}&mem_name=${this.mem_name}&mem_email=${this.mem_email}&mem_nick_name=${this.mem_nick_name}&mem_city=${this.mem_city}&mem_addr=${this.mem_addr}&mem_phone=${this.mem_phone}&mem_pic=${this.mem_pic}`;
                    
                    xhr.send(mem_deta);
                    //重新撈回資料庫資料，再寫進sessionStorage
                    xhr.onload = ()=>{
                        console.log(xhr.responseText);
                        if(xhr.status == 200){
                            this.session = JSON.parse(xhr.responseText);
                            console.log(this.session)
                            sessionStorage.setItem("member", JSON.stringify(this.session)); 
                            alert("修改成功");
                            let thus = this
                            thus.router.go(0)
                        }
                    }  
                }   
            }
        }
    }
}
</script>

<style  lang="scss" scoped>
@import '@/assets/scss/style.scss';
.mem_content_group{
    padding: 70px 0;
    h3{
        color:$color-str-green;
        margin-bottom: 20px;
    }
}
.mem_form{
    width: 100%;
    .tabcontent_text_group{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        .tabcontent_txt_group{
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        .tabcontent_txt{
            padding: 0 10px;
            text-align: start;
            li{
            padding: 10px 0;
            }
        }   
      }
    }
    .tabcontent_img{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px; 
    }
    .tabcontent_img li{
        width: 100px;
        margin:15px ;
        @include tb(){
            margin:5px ;
        } 
    }
    h4{
        color: $color-main-green;
    }
}
.tabcontent_txt{
    color:$color-basic-gray3;
}
.tab_label{
    p{
        font-weight: 600;
        padding: 3px 0;
    }
}
.input_none{
    display: none;
}
.input_none + img{
    cursor: pointer;
    border:2px solid transparent;
}
.input_none:checked + img{
    border: 4px solid $color-str-red;
}
.btn_confirm{
    cursor: pointer;
}
.input_addr{
    width: 300px;
}
</style>