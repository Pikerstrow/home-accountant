<template>
   <div>
      <div @click="toggleSwitcher"  :style="{'background-color': backgroundColor}" class="switcher-container" >
         <div ref="switcher" id="switcher">
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        name: "Switcher",
        props: ['value'],
        computed: {
            backgroundColor(){
                return this.value ? 'lightgreen' : 'lightgrey'
            }
        },
        methods: {
            toggleSwitcher(){
                let switcher = this.$refs.switcher;

                if(switcher.classList.contains('moveOn')){
                    switcher.classList.remove('moveOn');
                    switcher.classList.add('moveOff');
                } else if(switcher.classList.contains('moveOff')){
                    switcher.classList.remove('moveOff');
                    switcher.classList.add('moveOn');
                } else {
                    switcher.classList.add('moveOn');
                }

                /*For switcher container background and emitting an input event with correct params*/
                this.value = !this.value;
                this.$emit('input', this.value);

            }
        }
    }
</script>

<style scoped>
   .switcher-container {
      background-color: lightgrey;
      width: 40px;
      height: 14px;
      border-radius: 6px;
      position: relative;
      cursor: pointer;
      transition-duration: .2s;
   }
   #switcher {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      position: absolute;
      top: -3px;
   }
   #switcher {
      background-color: white;
      -webkit-box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
      -moz-box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
      box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
      left: 0;
   }

   .moveOn {
      animation: switchOn .2s;
      animation-fill-mode: forwards;
      animation-timing-function: ease-in-out
   }

   .moveOff {
      animation: switchOff .2s;
      animation-fill-mode: forwards;
      animation-timing-function: ease-in-out
   }


   @keyframes switchOn {
      from {
         left: 0;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
         -moz-box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
         box-shadow: 0px 0px 3px 3px rgba(181,181,181,1);
      }

      10%{
         left: 2px;
         -webkit-box-shadow: 0px 0px 3px 6px rgba(181,181,181,.8);
         -moz-box-shadow: 0px 0px 3px 6px rgba(181,181,181,.8);
         box-shadow: 0px 0px 3px 6px rgba(181,181,181,.8);
      }

      20%{
         left: 4px;
         -webkit-box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
      }

      30% {
         left: 6px;
         -webkit-box-shadow: 0px 0px 3px 12px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 12px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 12px rgba(181,181,181,.6);
      }

      40% {
         left:8px;
         -webkit-box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
      }

      50%{
         left: 10px;
         -webkit-box-shadow: 0px 0px 3px 18px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 18px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 18px rgba(181,181,181,.6);
      }

      60%{
         left: 12px;
         -webkit-box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 15px rgba(181,181,181,.6);
      }

      70% {
         left: 14px;
         -webkit-box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 9px rgba(181,181,181,.6);
      }

      80% {
         left: 16px;
         -webkit-box-shadow: 0px 0px 3px 6px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 6px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 6px rgba(181,181,181,.6);
      }

      90% {
         left: 18px;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
      }

      to {
         left: 20px;
         background-color: #00a600;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
         -moz-box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
         box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
      }
   }

   @keyframes switchOff {
      from {
         left: 20px;
         background-color: #00a600;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
         -moz-box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
         box-shadow: 0px 0px 3px 3px rgba(120,194,145,1);
      }

      10%{
         left: 18px;
         -webkit-box-shadow: 0px 0px 3px 6px rgba(120,194,145,.8);
         -moz-box-shadow: 0px 0px 3px 6px rgba(120,194,145,.8);
         box-shadow: 0px 0px 3px 6px rgba(120,194,145,.8);
      }

      20%{
         left: 16px;
         -webkit-box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
      }

      30% {
         left: 14px;
         -webkit-box-shadow: 0px 0px 3px 12px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 12px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 12px rgba(120,194,145,.6);
      }

      40% {
         left: 12px;
         -webkit-box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
      }

      50%{
         left: 10px;
         -webkit-box-shadow: 0px 0px 3px 18px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 18px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 18px rgba(120,194,145,.6);
      }

      60%{
         left: 8px;
         -webkit-box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 15px rgba(120,194,145,.6);
      }

      70% {
         left: 6px;
         -webkit-box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 9px rgba(120,194,145,.6);
      }

      80% {
         left: 4px;
         -webkit-box-shadow: 0px 0px 3px 6px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 6px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 6px rgba(120,194,145,.6);
      }

      90% {
         left: 2px;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(120,194,145,.6);
         -moz-box-shadow: 0px 0px 3px 3px rgba(120,194,145,.6);
         box-shadow: 0px 0px 3px 3px rgba(120,194,145,.6);
      }

      to {
         left: 0px;
         background-color: white;
         -webkit-box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
         -moz-box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
         box-shadow: 0px 0px 3px 3px rgba(181,181,181,.6);
      }
   }
</style>